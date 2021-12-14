<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class addjobController extends Controller
{
    public function index()
    {
        return view('modals.addJob');
    }
}
