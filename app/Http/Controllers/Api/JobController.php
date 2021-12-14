<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(JobStoreRequest $request)
    {
        Job::create($request->validated());

       // return response()->json($job);
    }
}
