<?php

namespace App\Repositories\Auth\Interfaces;

use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface AuthInterface extends BaseRepositoryInterface
{
    public function userRegister(RegisterRequest $request);

    public function userLogout(Request $request);

    public function isUserAuthenticated(AuthenticateRequest $request): bool;
}
