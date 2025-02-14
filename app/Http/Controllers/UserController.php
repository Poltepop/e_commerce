<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return Response()->view('auth.login',[
            'title' => 'Login',
        ]);
    }

    public function doLogin(Request $request): Response | RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        //Validate Input
        if(empty($email) || empty($password)){
            return response()->view('auth.login',[
                'title' => 'Login',
                'error' => 'Email Or Password Is Required',
            ]);
        } //If Email Or Password Is Empty

        if($this->userService->login($email, $password)){
            $request->session()->put('email', $email);
            return redirect('/');
        }// If Email Or Password Is Correct

        return response()->view('auth.login',[
            'title' => 'Login',
            'error' => 'Email Or Pasword Is Wrong'
        ]);// If Email Or Pasword Is Wrong
    }

    public function doLogout(){
        
    }
}
