<?php

namespace App\Http\Controllers;

use App\Http\Requests\MinistryStoreRequest;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ministries = Ministry::all();

        return view('ministries.index', compact('ministries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ministries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MinistryStoreRequest $request)
    {
        Ministry::create([
            'code' => $request->code,
            'description' => $request->description,
            'address' => $request->address,
            'p_o_box'=> $request->p_o_box,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'SRO' => $request->SRO,
        ]);

        return redirect()->route('ministries.index')->with('message', 'Ministry Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ministry  $ministry
     * @return \Illuminate\Http\Response
     */
    public function show(Ministry $ministry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ministry  $ministry
     * @return \Illuminate\Http\Response
     */
    public function edit(Ministry $ministry)
    {
       // $ministry = Ministry::all();
        return view('ministries.edit', compact('ministry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ministry  $ministry
     * @return \Illuminate\Http\Response
     */
    public function update(MinistryStoreRequest $request, Ministry $ministry)
    {
        $ministry->update([
            'code' => $request->code,
            'description' => $request->description,
            'address' => $request->address,
            'p_o_box'=> $request->p_o_box,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'SRO' => $request->SRO,
        ]);

        return redirect()->route('ministries.index')->with('message', 'Ministry Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ministry  $ministry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ministry $ministry)
    {
        $ministry->delete();

        return redirect()->route('ministries.index')->with('message', 'Ministry deleted successfully');
    }
}
