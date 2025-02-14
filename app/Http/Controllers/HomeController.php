<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function home(Request $request): RedirectResponse{
         if($request->session()->exists('email')){
            return redirect('/homepage');
         }else{
            return redirect('/login');
         }
    }
}
