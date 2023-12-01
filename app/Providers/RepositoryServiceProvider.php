<?php

namespace App\Providers;

use App\Models\Job;
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
    }
}
