<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDailyCounts()
    {
        $user_id = Auth::user()->id;

        $counts = Document::select(
                    DB::raw('DATE(created_at) as date'), 
                    DB::raw('count(*) as total'), 
                    DB::raw('SUM(IF(user_id = ' . $user_id . ',1,0)) as perUser')
                )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($counts);
    }

    public function getCategoriesCounts()
    {
        $user_id = Auth::user()->id;

        $counts = Document::select(
                        DB::raw('category_id'), 
                        DB::raw('count(*) as total'),
                        DB::raw('SUM(IF(user_id = ' . $user_id . ',1,0)) as perUser')
                    )
            ->groupBy('category_id')
            ->get();

        return response()->json($counts);
    }

    public function getUsersDocuments()
    {
        $user_id = Auth::user()->id;

        $counts = Document::select(
                        DB::raw('count(*) as total'),
                        DB::raw('SUM(IF(user_id = ' . $user_id . ',1,0)) as perUser')
                    )
            ->get();

        return response()->json($counts);
    }

    public function getUserDetails()
    {
        $user_id = Auth::user()->id;

        $user_details = User::where('id', $user_id)->get();

        $counts = Document::select(DB::raw('status'), DB::raw('count(*) as total'))
            ->where('user_id', $user_id)
            ->groupBy('status')
            ->get();

        return response()->json(['user_details' => $user_details, 'counts' => $counts]);
    }

    public function getRecentDocs()
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
            ->leftJoin('users', 'documents.user_id', '=', 'users.id')
            ->orderBy('documents.created_at', 'DESC')
            ->get()->take(5);

        return response()->json($documents);
    }
}
