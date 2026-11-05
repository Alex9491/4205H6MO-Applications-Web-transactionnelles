<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'courriel' => ['required', 'email'],
            'motdepasse' => ['required', 'string'],
        ]);

        if (! Auth::attempt([
            'courriel' => $credentials['courriel'],
            'password' => $credentials['motdepasse'],
        ])) {
            return back()
                ->withErrors(['courriel' => 'Identifiants invalides.'])
                ->onlyInput('courriel');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('recettes.index'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('recettes.index');
    }
}