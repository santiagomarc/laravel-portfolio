<?php
// filepath: app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        // If already logged in, redirect to resume
        if (Session::get('logged_in')) {
            return redirect()->route('resume');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login authentication
     */
    public function authenticate(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = trim($request->username);
        $password = trim($request->password);

        // Simple credential check
        if ($username === 'admin' && $password === '1234') {
            // Set session
            Session::put('logged_in', true);
            Session::put('username', $username);
            
            return redirect()->route('resume')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'credentials' => 'Invalid username or password.'
        ])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}