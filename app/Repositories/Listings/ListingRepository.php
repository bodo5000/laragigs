<?php

namespace App\Repositories\Listings;

use App\Http\Requests\Listings\ListingRequest;
use App\Models\Listing;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

class ListingRepository extends BaseRepository implements ListingRepositoryInterface
{

    public function createListing(ListingRequest $request)
    {
        $form_data = $request->all();
        $form_data['user_id'] = auth()->id();

        if ($this->requestFileExists('logo')) {
            $form_data['logo'] = $this->saveImage('logo', 'logos');
        }

        return $this->create($form_data);
    }

    public function updateListing(ListingRequest $request, Listing $listing)
    {
        $form_data = $request->all();

        if ($this->requestFileExists('logo')) {

            $this->deleteImage($listing->logo);
            $form_data['logo'] = $this->saveImage('logo', 'logos');
        }

        return $this->update($listing, $form_data);
    }

    public function destroyListing(Listing $listing)
    {
        if ($listing->logo) {
            Storage::disk('public')->delete($listing->logo);
        }

        return $this->destroy($listing);
    }
}
