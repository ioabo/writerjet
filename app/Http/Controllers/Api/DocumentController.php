<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use FontLib\Table\Type\name;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $documents = Document::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

        // $empty_documents = true;

        if (!$documents->isEmpty()) {

            if ($request->search) {
                $documents = Document::where(function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->where(function ($query) use ($request) {
                    $query->where('category_id', "like", "%{$request->search}%")
                        ->orWhere('subject', "like", "%{$request->search}%")
                        ->orWhere('status', "like", "%{$request->search}%")
                        ->orWhere('created_at', "like", "%{$request->search}%")
                        ->orderBy('created_at', 'DESC');
                })->get();
            };
            $empty_documents = false;


            if (!$documents->isEmpty()) {
                $empty_documents = false;
            }else{
                $empty_documents = true;
            }
        }else{
            $empty_documents = true;
        }

        return response()->json(['documents' => $documents,'empty_documents' => $empty_documents]);
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
    public function store(DocumentStoreRequest $request)
    {
        $document = Document::create($request->validated());

        return response()->json($document);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return new DocumentResource($document);
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
    public function update(DocumentStoreRequest $request, Document $document)
    {
        $document->update($request->validated());

        return response()->json('Template Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getArchives(Request $request)
    {
        $documents = DB::table('documents')
            ->select(
                'documents.created_at',
                'documents.category_id',
                'documents.file_ref',
                'documents.subject',
                'documents.user_id',
                'users.name',
                'documents.pdf_url'
            )
            ->where('status', 'Final')
            ->leftJoin('users', 'documents.user_id', '=', 'users.id')
            ->orderBy('documents.created_at', 'DESC')
            ->get();


        if ($documents->isEmpty()) {
            $empty_documents = true;
        } else {

            if ($request->search) {
                $documents = DB::table('documents')
                    ->where(function ($query) {
                        $query->where('status', 'Final');
                    })
                    ->where(function ($query) use ($request) {
                        $query->where('category_id', "like", "%{$request->search}%")
                            ->orWhere('subject', "like", "%{$request->search}%")
                            ->orWhere('status', "like", "%{$request->search}%")
                            ->orWhere('documents.created_at', "like", "%{$request->search}%");
                    })
                    ->leftJoin('users', function ($join) {
                        $join->on('documents.user_id', '=', 'users.id');
                    })
                    ->orderBy('documents.created_at', 'DESC')
                    ->get();
            };

            $empty_documents = false;

            if ($documents->isEmpty()) {
                $empty_documents = true;
            } else {
                $empty_documents = false;
            }
        }
        
        return response()->json(['documents' => $documents, 'empty_documents' => $empty_documents]);
    }

    public function forSecretariesFilter(Request $request)
    {
        $documents = DB::table('documents')
            ->select(
                'documents.created_at',
                'documents.category_id',
                'documents.file_ref',
                'documents.subject',
                'documents.user_id',
                'users.name',
                'documents.pdf_url',
                'documents.for_secretary'
            )
            ->where('documents.status', 'Final')
            ->where('documents.for_secretary', '1')
            ->leftJoin('users', 'documents.user_id', '=', 'users.id')
            ->orderBy('documents.created_at', 'DESC')
            ->get();


        if ($documents->isEmpty()) {
            $empty_documents = true;
        } else {

            if ($request->search) {
                $documents = DB::table('documents')
                    ->where(function ($query) {
                        $query->where('status', 'Final');
                    })
                    ->where(function ($query) {
                        $query->where('for_secretary', '1');
                    })
                    ->where(function ($query) use ($request) {
                        $query->where('category_id', "like", "%{$request->search}%")
                            ->orWhere('subject', "like", "%{$request->search}%")
                            ->orWhere('status', "like", "%{$request->search}%")
                            ->orWhere('documents.created_at', "like", "%{$request->search}%");
                    })
                    ->leftJoin('users', function ($join) {
                        $join->on('documents.user_id', '=', 'users.id');
                    })
                    ->orderBy('documents.created_at', 'DESC')
                    ->get();
            };

            $empty_documents = false;

            if ($documents->isEmpty()) {
                $empty_documents = true;
            } else {
                $empty_documents = false;
            }
        }
        
        return response()->json(['documents' => $documents, 'empty_documents' => $empty_documents]);
    }

    public function getDrafts(Request $request)
    {
        $user_id = Auth::user()->id;

        $documents = DB::table('documents')
            ->select(
                'documents.id',
                'documents.created_at',
                'documents.category_id',
                'documents.file_ref',
                'documents.subject',
                'documents.user_id',
                'users.name',
                'documents.pdf_url'
            )
            ->where('status', 'Draft')
            ->where('user_id', $user_id)
            ->leftJoin('users', 'documents.user_id', '=', 'users.id')
            ->orderBy('documents.created_at', 'DESC')
            ->get();


        if ($documents->isEmpty()) {
            $empty_documents = true;
        } else {

            if ($request->search) {
                $documents = DB::table('documents')
                    ->where(function ($query) {
                        $query->where('status', 'Draft');
                    })
                    ->where(function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    })
                    ->where(function ($query) use ($request) {
                        $query->where('category_id', "like", "%{$request->search}%")
                            ->orWhere('subject', "like", "%{$request->search}%")
                            ->orWhere('status', "like", "%{$request->search}%")
                            ->orWhere('documents.created_at', "like", "%{$request->search}%");
                    })
                    ->leftJoin('users', function ($join) {
                        $join->on('documents.user_id', '=', 'users.id');
                    })
                    ->orderBy('documents.created_at', 'DESC')
                    ->get();
            };

            $empty_documents = false;

            if ($documents->isEmpty()) {
                $empty_documents = true;
            } else {
                $empty_documents = false;
            }
        }
        
        return response()->json(['documents' => $documents, 'empty_documents' => $empty_documents]);
    }
}
