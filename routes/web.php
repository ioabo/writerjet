<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/subjects/{category}', [SubjectController::class, 'create'])->name('subjects.create');
Route::get('/subjects/{category}/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::resource('/ministries', MinistryController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/subjects', SubjectController::class)->except([
    'create','edit'
]);

Route::get('{any}', function(){
    return view('documents.index');
})->where('any', '.*');