<?php

use App\Http\Controllers\addjobController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\dompdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\PDFcontroller;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/subjects/{category}', [SubjectController::class, 'create'])->name('subjects.create');
    Route::get('/subjects/{category}/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::resource('/ministries', MinistryController::class);

    Route::resource('/categories', CategoryController::class);
    Route::resource('/subjects', SubjectController::class)->except([
        'create', 'edit'
    ]);

    // Route::resource('divisions', DivisionController::class)->except([
    //     'index', 'create', 'store', 'edit', 'update', 'delete'
    // ]);

    Route::get('ministry/divisions/{ministry}', [DivisionController::class, 'index'])->name('divisions.index');
    Route::get('ministry/divisions/create/{ministry}', [DivisionController::class, 'create'])->name('divisions.create');
    Route::post('ministry/divisions/store/{ministry}', [DivisionController::class, 'store'])->name('divisions.store');
    Route::get('ministry/divisions/edit/{division}/{ministry}', [DivisionController::class, 'edit'])->name('divisions.edit');
    Route::put('ministry/divisions/update/{division}/{ministry}', [DivisionController::class, 'update'])->name('divisions.update');
    Route::delete('division/delete/{division}/{ministry}', [DivisionController::class, 'destroy'])->name('divisions.destroy');


    Route::resource('/units', UnitController::class);

    Route::get('/dompdf/{document}', [dompdfController::class, 'genPDF']);
    Route::get('/dompdf/{document}/download', [dompdfController::class, 'downloadPDF']);
    Route::get('/pdfwebview', [dompdfController::class, 'web_view']);

    Route::get('/addJob', [addjobController::class, 'index']);

    // Route::get('{any}', function () {
    //     return view('home');
    // })->where('any', 'dashboard');

    Route::get('{any}', function () {
        return view('documents.index');
    })->where('any', '.*');
});

Route::resource('/users', UserController::class);
