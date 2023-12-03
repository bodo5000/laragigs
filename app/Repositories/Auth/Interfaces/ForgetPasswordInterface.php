<?php

namespace App\Repositories\Auth\Interfaces;

use App\Http\Requests\Password\ForgetPasswordRequest;
use App\Http\Requests\Password\ResetPasswordRequest;
use App\Repositories\BaseRepositoryInterface;

interface ForgetPasswordInterface extends BaseRepositoryInterface
{
    public function sendEmailVerify(ForgetPasswordRequest $request);

    public function resetPassword(ResetPasswordRequest $request);
}
