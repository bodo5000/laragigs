<?php

namespace App\Repositories\Listings;

use App\Http\Requests\Listings\ListingRequest;
use App\Models\Listing;
use App\Repositories\BaseRepositoryInterface;

interface ListingRepositoryInterface extends BaseRepositoryInterface
{
    public function createListing(ListingRequest $request);

    public function updateListing(ListingRequest $request, Listing $listing);

    public function destroyListing(Listing $listing);
}
