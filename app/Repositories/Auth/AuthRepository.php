<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\Interfaces\AuthInterface;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends BaseRepository implements AuthInterface
{
    public function userRegister(RegisterRequest $request)
    {
        $form_data = $request->all();
        $form_data['password'] = bcrypt($form_data['password']);

        return Auth::login($this->create($form_data));
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function isUserAuthenticated(AuthenticateRequest $request): bool
    {
        $form_data = $request->except(['_token']);

        return Auth::attempt($form_data);
    }
}
