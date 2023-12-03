<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\ForgetPasswordRepository;
use App\Repositories\Auth\GoogleAuthRepository;
use App\Repositories\Auth\Interfaces\AuthInterface;
use App\Repositories\Auth\Interfaces\ForgetPasswordInterface;
use App\Repositories\Auth\Interfaces\GoogleAuthInterface;
use App\Repositories\Jobs\JobRepository;
use App\Repositories\Jobs\JobRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(JobRepositoryInterface::class, function () {
            return new JobRepository(new Job());
        });

        $this->app->bind(AuthInterface::class, function () {
            return new AuthRepository(new User());
        });

        $this->app->bind(GoogleAuthInterface::class, function () {
            return new GoogleAuthRepository(new User());
        });

        $this->app->bind(ForgetPasswordInterface::class, function () {
            return new ForgetPasswordRepository(new user());
        });
    }
}
