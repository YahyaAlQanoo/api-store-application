<?php

namespace App\Http\Controllers\Auth;
use Dotenv\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin()
    {
        return response()->view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email|exists:admins,email',
            'password' => 'required|string|max:100',
        ]);

         
 
            $credentials =['email'=> $request->input('email'),'password'=> $request->input('password')];
             
            if(Auth::guard('admin')->attempt($credentials, $request->input('remember'))) {
                // return redirect()->route('complaints.index');
                // dd(55555,$credentials);
                return redirect()->route('category.index');
            } else {
                return redirect()->route('auth.login');
            }
            
            return redirect()->route('auth.login');

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->guest(route('auth.login'));
    }
    
}
