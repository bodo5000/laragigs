<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $form_data = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => ['required', Rule::unique('users', 'email'), 'email'],
                'password' => ['required', 'confirmed', 'min:6'],
            ]
        );

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
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $form_data = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]
        );

        if (!Auth::attempt($form_data)) {
            return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/')->with('message', 'user has been LoggedIn');
    }
}
