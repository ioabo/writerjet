<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivesController extends Controller
{
    public function getArchives( Request $request)
    {
        $user_id = Auth::user()->id;
        $documents = Document::where('status', 'Final')->orderBy('created_at', 'DESC')->get();

        if($request->search){
            $documents = Document::where(function($query){
                $query->where('documents.status', 'Final');
            })->where(function($query) use ($request){
                $query->where('category_id', "like", "%{$request->search}%")->
                        orWhere('subject', "like", "%{$request->search}%")->
                        orWhere('status', "like", "%{$request->search}%")->
                        orWhere('created_at', "like", "%{$request->search}%")->
                        orderBy('created_at', 'DESC');
            })->get();
        };

        return response()->json($documents);
    }
}
