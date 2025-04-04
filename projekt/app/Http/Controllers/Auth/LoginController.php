<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ]);


        $user = User::where('email', $credentials['login'])
            ->orWhere('username', $credentials['login'])
            ->first();


        if ($user && $user->password === $credentials['password']) {
            $request->session()->regenerate();
            auth()->login($user); // Nastaví session


            if ($user->username === 'admin') {
                return redirect()->route('adminPage');
            }

            return redirect()->route('index');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }
}
