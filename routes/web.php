<?php

use App\Http\Controllers\AnnotationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('annotate', [AnnotationController::class, 'displayForm'])->name('displayForm');

Route::post('annotate', [AnnotationController::class, 'annotateImage'])->name('annotateImage');
