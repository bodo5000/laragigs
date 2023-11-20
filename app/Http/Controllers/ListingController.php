<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index()
    {
        return view(
            'listings.index',
            [
                'listings' => Listing::latest()
                    ->filter(request(['tag', 'search']))
                    ->paginate(5)
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

    public function store(Request $request)
    {

        $form_data = $request->validate(
            [
                'title' => 'required',
                'company' => ['required', Rule::unique('listings', 'company')],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required',
            ]
        );

        $form_data['user_id'] = auth()->id();

        if ($request->hasFile('logo')) {
            $form_data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($form_data);

        return redirect('/')->with('message', 'Listing has been created');
    }


    public function edit(Listing $listing)
    {

        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {

        $form_data = $request->validate(
            [
                'id' => 'required',
                'title' => 'required',
                'company' => ['required', Rule::unique('listings', 'company')->ignore($listing->id, 'id')],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        if ($request->hasFile('logo')) {

            Storage::disk('public')->delete($listing->logo);
            $form_data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($form_data);

        return redirect("/listings/{$listing->id}")->with('message', 'Listing has been updated');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->logo) {
            Storage::disk('public')->delete($listing->logo);
        }

        $listing->destroy($listing->id);

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
