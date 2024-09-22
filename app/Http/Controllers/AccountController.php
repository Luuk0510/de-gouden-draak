<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function showLoginForm()
    {
        return view('register.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'gebruikersnaam' => 'required|string',
            'wachtwoord' => 'required|string',
        ]);

        $credentials = $request->only('gebruikersnaam', 'wachtwoord');

        if (Auth::attempt(['gebruikersnaam' => $credentials['gebruikersnaam'], 'password' => $credentials['wachtwoord']])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('login_error', 'Onbekende combinatie medewerker nummer en wachtwoord');
        }
    }

    public function logout()
    {
        return view('register.login');
    }
}

