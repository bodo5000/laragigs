<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\Auth\Interfaces\GoogleAuthInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthRepository extends BaseRepository implements GoogleAuthInterface
{
    public function getGoogleUser()
    {
        return Socialite::driver('google')->user();
    }

    public function isGoogleUserExists($google_user)
    {
        return User::where('email', '=', $google_user->getEmail())->first();
    }

    public function createGoogleUser($google_user)
    {

        return User::create([
            'name' => $google_user->getName(),
            'email' => $google_user->getEmail(),
            'google_id' => $google_user->getId()
        ]);
    }

    public function GoogleAuth()
    {
        $google_user = $this->getGoogleUser();

        $user = $this->isGoogleUserExists($google_user);

        if (!$user) {

            Auth::login($this->createGoogleUser($google_user));
            return true;
        }

        Auth::login($user);
        return false;
    }
}
