<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        try {

            $google_user = Socialite::driver('google')->user();

            $user = User::where('email', '=', $google_user->getEmail())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);

                Auth::login($new_user);

                return redirect('/')->with('message', 'user has been LoggedIn');
            }

            Auth::login($user);
            return redirect('/')->with('message', 'user has been LoggedIn');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
