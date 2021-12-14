<?php

use App\Http\Controllers\Api\ArchivesController;
use App\Http\Controllers\Api\ChartsController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\DocumentDataController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\dompdfController;
use App\Http\Controllers\Api\UserController;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/documents/ministries', [DocumentDataController::class, 'ministries']);
Route::get('/documents/categories', [DocumentDataController::class, 'categories']);
Route::get('/documents/jobs', [DocumentDataController::class, 'jobs']);
// Route::get('/documents/templates', [DocumentDataController::class, 'templates']);

Route::post('jobs', [JobController::class, 'store']);

Route::apiResource('documents', DocumentController::class);
Route::apiResource('templates', TemplateController::class);
Route::apiResource('users', UserController::class);

Route::get('/activate/{user}', [UserController::class, 'activateUser']);
Route::get('/promote/{user}', [UserController::class, 'promoteUser']);
Route::get('/demote/{user}', [UserController::class, 'demoteUser']);

Route::get('/document/{template}', [TemplateController::class, 'showFromTemplate']);
// Route::delete('/delete/{template}', [TemplateController::class, 'destroy2']);

// Route::get('/dompdf/{document}', [dompdfController::class, 'genPDF']);

Route::get('/document/dompdf/{document}', [DocumentController::class, 'generatePDF']);
Route::get('archives', [DocumentController::class, 'getArchives']);
Route::get('drafts', [DocumentController::class, 'getDrafts']);
Route::get('archives/forsecretaries', [DocumentController::class, 'forSecretariesFilter']);

// Dashboard Routes
Route::get('/userdocuments', [DashboardController::class, 'getUsersDocuments']);
Route::get('/dailycounts', [DashboardController::class, 'getDailyCounts']);
Route::get('/categories', [DashboardController::class, 'getCategoriesCounts']);
Route::get('/userprofile', [DashboardController::class, 'getUserDetails']);
Route::get('/recentdocs', [DashboardController::class, 'getRecentDocs']);

//Route::post('/employees',[::class, 'store']);
