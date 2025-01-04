<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.customer.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Tampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.customer.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
            'no_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $data['password'] = Hash::make($data['password']);
        Customer::create($data);

        return redirect()->route('login_user')->with('success', 'Registration successful. Please login.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_user');
    }
}
