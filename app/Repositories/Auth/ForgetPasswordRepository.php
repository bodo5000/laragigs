<?php

namespace App\Repositories\Auth;

use App\Http\Requests\Password\ForgetPasswordRequest;
use App\Http\Requests\Password\ResetPasswordRequest;
use App\Models\User;
use App\Repositories\Auth\Interfaces\ForgetPasswordInterface;
use App\Repositories\BaseRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgetPasswordRepository extends BaseRepository implements ForgetPasswordInterface
{
    public function sendEmailVerify(ForgetPasswordRequest $request)
    {
        return Password::sendResetLink($request->only('email'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
