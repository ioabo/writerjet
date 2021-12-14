<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionStoreRequest;
use App\Models\Division;
use App\Models\Ministry;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $divisions = Division::where('ministry_id', $id)->get();
        $ministry = Ministry::where('id', $id)->first();

        return view('divisions.index', compact('divisions', 'ministry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ministry = Ministry::where('id', $id)->first();
        return view('divisions.create', compact('ministry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionStoreRequest $request, $id)
    {
        $ministry = Ministry::where('id', $id)->first();

        Division::create($request->validated());

        return redirect()->route('divisions.index', $ministry->id)->with('message', 'Successfully added division for ' . $ministry->code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division, Ministry $ministry)
    {
        // $ministry = Ministry::where('id', $id)->first();
        return view('divisions.edit', compact('division', 'ministry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(DivisionStoreRequest $request, Division $division, $id)
    {
       $ministry = Ministry::where('id', $id)->first();

        $division->update([
            'ministry_id' => $request->ministry_id,
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('divisions.index', $ministry->id)->with('message', 'Successfully updated division for ' . $ministry->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division, $id)
    {
        $ministry = Ministry::where('id', $id)->first();

        $division->delete();

        return redirect()->route('divisions.index', $ministry->id)->with('message', 'Successfully updated division for ' . $ministry->code);
    }
}
