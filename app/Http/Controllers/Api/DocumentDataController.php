<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\Ministry;
use App\Models\Template;
use Illuminate\Http\Request;

class DocumentDataController extends Controller
{
    public function ministries()
    {
        $ministries = Ministry::all();
        return response()->json($ministries);
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function jobs()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    // public function templates()
    // {
    //     $templates = Template::all();
    //     return response()->json($templates);
    // }
}