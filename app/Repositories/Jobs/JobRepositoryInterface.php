<?php

namespace App\Repositories\Jobs;

use App\Http\Requests\Job\JobRequest;
use App\Models\Job;
use App\Repositories\BaseRepositoryInterface;

interface JobRepositoryInterface extends BaseRepositoryInterface
{
    public function createJob(JobRequest $request);

    public function updateJob(JobRequest $request, Job $listing);

    public function destroyJob(Job $listing);
}
