<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listings\ListingRequest;
use App\Models\Listing;
use App\Models\User;
use App\Repositories\Listings\ListingRepositoryInterface;



class ListingController extends Controller
{

    public function __construct(private ListingRepositoryInterface $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }

    public function index()
    {
        return view(
            'listings.index',
            [
                'listings' => $this->listingRepository->getDisc_Paginating_Filtering(5, ['tag', 'search'])
            ]
        );
    }

    public function show(Listing $listing)
    {

        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {

        return view('listings.create');
    }

    public function store(ListingRequest $request)
    {

        $this->listingRepository->createListing($request);

        return redirect('/')->with('message', 'Listing has been created');
    }

    public function edit(Listing $listing)
    {

        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(ListingRequest $request, Listing $listing)
    {
        $this->listingRepository->updateListing($request, $listing);
        return redirect("/listings/{$listing->id}")->with('message', 'Listing has been updated');
    }

    public function destroy(Listing $listing)
    {

        $this->listingRepository->destroyListing($listing);

        return redirect('/')->with('message', 'Listing Deleted');
    }


    public function manage($id)
    {
        $user = User::find($id);

        if ($user == auth()->user()) {
            $listings = $user->listings;
        }

        return view('listings.manage', ['listings' => $listings]);
    }
}
