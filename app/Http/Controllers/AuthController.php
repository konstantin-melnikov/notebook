<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        return view('loginForm');
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('notebook');
        }
        return back()->withErrors(
            [
                'login' => 'Bad email or password',
            ]
        )->withInput($request->except('password'));
    }

    public function registerForm(Request $request)
    {
        return view('registerForm');
    }

    public function createUser(Request $request)
    {
        //todo Create and verify user
        $validData = $request->validate(
            [
                'email' => 'required|email:rfc|unique:App\Models\User,email',
                'password' => 'required|string|min:12|confirmed',
            ]
        );
        $user = User::create([
            'email'    => $validData['email'],
            'password' => bcrypt($validData['password'])
        ]);
        return redirect()->route('loginForm')->with('message', 'User created successfully!');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm');
    }
}
