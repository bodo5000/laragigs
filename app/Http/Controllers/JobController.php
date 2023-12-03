<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Http\Requests\Job\JobRequest;
use App\Repositories\Jobs\JobRepositoryInterface;


class JobController extends Controller
{

    public function __construct(private JobRepositoryInterface $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }

    public function index()
    {
        return view(
            'listings.index',
            [
                'listings' => $this->listingRepository->getDesc_Paginating_Filtering(5, ['tag', 'search'])
            ]
        );
    }

    public function show(Job $listing)
    {

        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(JobRequest $request)
    {
        $this->listingRepository->createJob($request);

        return redirect('/')->with('message', 'Job has been created');
    }

    public function edit(Job $listing)
    {

        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(JobRequest $request, Job $listing)
    {
        $this->listingRepository->updateJob($request, $listing);
        return redirect("/listings/{$listing->id}")->with('message', 'Job has been updated');
    }

    public function destroy(Job $listing)
    {

        $this->listingRepository->destroyJob($listing);

        return redirect('/')->with('message', 'Job Deleted');
    }


    public function manage($id)
    {

        return view('listings.manage', ['listings' => $this->listingRepository->manageJobs($id)]);
    }
}
