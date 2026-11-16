<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:admin,user',
        ]);

        // email + password + role harus cocok semua dengan data di tabel users
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('vouchers.index');
        }

        return back()
            ->withErrors(['email' => 'Email, password, atau peran salah.'])
            ->onlyInput('email', 'role');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}