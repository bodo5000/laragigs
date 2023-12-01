<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\AuthenticateRequest;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $form_data = $request->all();

        $form_data['password'] = bcrypt($form_data['password']);

        $user =  User::create($form_data);

        Auth::login($user);

        return redirect('/')->with('message', 'user has been created and loggedIn');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'user has been logout');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $form_data = $request->except(['_token']);

        if (!Auth::attempt($form_data)) {
            return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/')->with('message', 'user has been LoggedIn');
    }
}
