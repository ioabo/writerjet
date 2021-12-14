<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateStoreRequest;
use App\Http\Resources\TemplateResource;
use App\Models\Template;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $templates = Template::all();

        if($request->search){
            $templates = Template::where('category_id', "like", "%{$request->search}%")->
                                   orWhere('subject', "like", "%{$request->search}%")->get();
        }

        return response()->json($templates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateStoreRequest $request)
    {
        Template::create($request->validated());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
         return new TemplateResource($template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateStoreRequest $request, Template $template)
    {
        $template->update($request->validated());

        return response()->json('Template Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return response()->json('Template Deleted Successfuly');
    }

    public function showFromTemplate(Template $template){
        return new TemplateResource($template);
    }

    // public function destroy2(Template $template)
    // {
    //     $template->delete();

    //     // return response()->json('Template Deleted Successfuly');
    // }
}
