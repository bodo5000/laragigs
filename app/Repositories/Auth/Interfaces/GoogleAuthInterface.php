<?php

namespace App\Repositories\Auth\Interfaces;

use App\Repositories\BaseRepositoryInterface;

interface GoogleAuthInterface extends BaseRepositoryInterface
{
    public function getGoogleUser();

    public function isGoogleUserExists($google_user);

    public function createGoogleUser($google_user);

    public function GoogleAuth();
}
