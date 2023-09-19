<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Models\Applicant;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/table', function () {
    return view('table');
});
Route::controller(ApplicantController::class)->group(function(){
    Route::get('/data', [ApplicantController::class, 'index'])->name('data');
    Route::get('/data/fetch_data', [ApplicantController::class, 'fetch_data'])->name('fetch_data');    
});
Route::get('/search', [ApplicantController::class, 'search'])->name('search');
Route::get('/add', [ApplicantController::class, 'create'])->name('create');
Route::post('/store', [ApplicantController::class, 'store'])->name('store');
Route::get('/edit/{id}', [ApplicantController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [ApplicantController::class, 'update'])->name('update');
Route::get('/skill', [ApplicantController::class, 'addSkill'])->name('skill');
Route::post('/save', [ApplicantController::class, 'save'])->name('save');
Route::post('/deleteSkill/{id}', [ApplicantController::class, 'deleteSkill'])->name('deleteSkill');
Route::delete('/delete/{id}', [ApplicantController::class, 'destroy'])->name('delete');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
