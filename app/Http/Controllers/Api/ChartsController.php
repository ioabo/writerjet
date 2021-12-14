<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{
    public function getDailyCounts(){

        $counts = Document::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($counts);

    }

    public function getCategoriesCounts(){

        $counts = Document::select(DB::raw('category_id'), DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->get();

        return response()->json($counts);

    }
}
