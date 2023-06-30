<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->intended('home');
        }

        return view('auth.register');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('home');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        if (Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email', 'username');
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();

        $user = User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Auth::login($user);

        return redirect()->intended('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
