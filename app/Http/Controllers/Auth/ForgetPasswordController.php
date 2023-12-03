<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ForgetPasswordRequest;
use App\Http\Requests\Password\ResetPasswordRequest;
use App\Repositories\Auth\Interfaces\ForgetPasswordInterface;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{

    public function __construct(private ForgetPasswordInterface $forgetPasswordRepository)
    {
        $this->forgetPasswordRepository = $forgetPasswordRepository;
    }

    public function start_forgetPassword()
    {
        return view('auth.forget_password');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {

        $status = $this->forgetPasswordRepository->sendEmailVerify($request);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function password_reset(string $token)
    {
        return view('auth.password_reset', ['token' => $token]);
    }

    public function password_update(ResetPasswordRequest $request)
    {

        $status = $this->forgetPasswordRepository->resetPassword($request);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
