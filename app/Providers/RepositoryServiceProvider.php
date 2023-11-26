<?php

namespace App\Providers;

use App\Models\Listing;
use App\Repositories\Listings\ListingRepository;
use App\Repositories\Listings\ListingRepositoryInterface;
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
        $this->app->bind(ListingRepositoryInterface::class, function () {
            return new ListingRepository(new Listing());
        });
    }
}
