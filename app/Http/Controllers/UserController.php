<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function doLogin(Request $request)
    {
        try{
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        if($this->userService->login($credentials)){
            return redirect()->route('homepage');
        }

        return back()->withErrors([
            'wrong' => 'User Or Password Is Wrong'
        ]);

    }

    public function doLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
    
        return redirect('/');
    }

    public function formRegisterView(){
        return Response()->view('auth.register', [
            'title' => 'register'
        ]);
    }

    public function register(Request $request){
        try {
            $credentials = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required'
            ]);
        }catch(ValidationException $e){
            $firstError = $e->validator->errors()->first();
            return back()->withErrors([
                'required' => $firstError
            ]);
        }

        $this->userService->register($credentials);

        return redirect()->action([UserController::class, 'login']);
    }
}
