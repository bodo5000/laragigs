<?php

namespace App\Repositories\Jobs;

use App\Http\Requests\Job\JobRequest;
use App\Models\Job;
use App\Models\User;
use App\Repositories\BaseRepository;


class JobRepository extends BaseRepository implements JobRepositoryInterface
{

    public function createJob(JobRequest $request)
    {
        $form_data = $request->all();
        $form_data['user_id'] = auth()->id();

        if ($this->requestFileExists('logo')) {
            $form_data['logo'] = $this->saveImage('logo', 'logos');
        }

        return $this->create($form_data);
    }

    public function updateJob(JobRequest $request, Job $listing)
    {

        $form_data = $request->all();

        if ($this->requestFileExists('logo')) {

            $this->deleteImage($listing->logo);
            $form_data['logo'] = $this->saveImage('logo', 'logos');
        }

        return $this->update($listing, $form_data);
    }

    public function destroyJob(Job $listing)
    {
        if ($listing->logo) {
            $this->deleteImage($listing->logo);
        }

        return $this->destroy($listing);
    }

    public function manageJobs($id)
    {
        $user = User::find($id);

        if ($user == auth()->user()) {
            return  $user->listings;
        }
    }
}
