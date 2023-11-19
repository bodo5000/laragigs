<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
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
                'email' => ['required', Rule::unique('listings', 'email'), 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        if ($request->hasFile('logo')) {
            $form_data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($form_data);

        return redirect('/')->with('message', 'Listing has been created');
    }
}
