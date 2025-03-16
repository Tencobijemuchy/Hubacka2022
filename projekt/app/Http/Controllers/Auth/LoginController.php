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
        return view('auth.login'); // Tvoja prihlasovacia Blade šablóna
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login'    => 'required',  // môže to byť email alebo username
            'password' => 'required',
        ]);

        // Vyhľadáme používateľa podľa emailu alebo username
        $user = User::where('email', $credentials['login'])
            ->orWhere('username', $credentials['login'])
            ->first();

        // Porovnáme heslo priamo (plain text)
        if ($user && $user->password === $credentials['password']) {
            $request->session()->regenerate();
            auth()->login($user); // Nastaví session

            // Ak je používateľ admin, presmeruj na adminPage, inak na index
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
