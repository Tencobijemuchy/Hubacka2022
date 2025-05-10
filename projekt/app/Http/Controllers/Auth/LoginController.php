<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        //dd($credentials, $user);


        if ($user && Hash::check($credentials['password'], $user->password)) {
            $request->session()->regenerate();
            auth()->login($user);

            if ($user->is_admin) {
                return redirect()->route('adminPage');
            }
            return redirect()->route('index');
        }



        return back()
            ->withErrors([
                'login' => 'Invalid credentials. Please try again.',
            ])
            ->withInput()
            ->with('login_failed', true);
    }
}
