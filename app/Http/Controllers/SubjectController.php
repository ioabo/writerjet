<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectStoreRequest;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('subjects.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        Subject::create($request->validated());

        return redirect()->route('categories.show', $request->category_id)->with('message', 'Subject Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $subjects = Subject::where('category_id', $category->id)->get();
        //$subjects = Subject::all();

        return view('subjects.index', compact('subjects','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Subject $subject)
    {
        return view('subjects.edit', compact('subject', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectStoreRequest $request, Subject $subject)
    {
        $subject->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->route('categories.show', $subject->category_id)->with('message', 'Subject updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('categories.show', $subject->category_id)->with('message', 'Category deleted successfully');
    }
}
