<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // jangan lupa import Auth

class AuthController extends Controller
{
    // Method untuk menampilkan form login
    public function showLoginForm()
    {
        return view('movies.login');
    }

    // Method untuk proses login
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home')->with('success', 'Login Success! ' . Auth::user()->name);
        }

        return back()->withErrors(
            [
                'email' => 'Email not found'
            ]
        )->onlyInput('email');
    }
     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
