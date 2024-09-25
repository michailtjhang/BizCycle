<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect()->intended('admin/dashboard');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false;

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Incorrect password. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found. Please register first.');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function auth_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($user) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
