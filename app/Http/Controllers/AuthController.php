<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return response()->json(['status' => true, 'message' => 'Login successful!']);
        }

        return response()->json([
            'status' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 422);
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function register(){
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'Registration successful! You can now log in.');
        return response()->json(['status'=>true,'message' => 'Registration successful! You can now log in.']);
    }

}
