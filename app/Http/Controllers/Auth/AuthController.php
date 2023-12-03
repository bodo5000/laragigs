<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Repositories\Auth\Interfaces\AuthInterface;

class AuthController extends Controller
{

    public function __construct(private AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {

        $this->authRepository->userRegister($request);

        return redirect('/')->with('message', 'user has been created and loggedIn');
    }


    public function logout(Request $request)
    {

        $this->authRepository->userLogout($request);

        return redirect('/')->with('message', 'user has been logout');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {

        if (!($this->authRepository->isUserAuthenticated($request))) {
            return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/')->with('message', 'user has been LoggedIn');
    }
}
