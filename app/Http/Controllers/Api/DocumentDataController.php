<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use Illuminate\Http\Request;

class DocumentDataController extends Controller
{
    public function ministries()
    {
        $ministries = Ministry::all();
        return response()->json($ministries);
    }
}