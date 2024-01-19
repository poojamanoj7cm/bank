<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Register;
use App\Models\User;



class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            return redirect()->route('home')->with('success', 'Login successful.');
        }

       
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
