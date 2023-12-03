<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Auth\Interfaces\GoogleAuthInterface;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{

    public function __construct(private GoogleAuthInterface $googleAuthRepository)
    {
        $this->googleAuthRepository = $googleAuthRepository;
    }

    public function redirect_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        try {
            $this->googleAuthRepository->GoogleAuth();
            return redirect('/')->with('message', 'user has been LoggedIn');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
