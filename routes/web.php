<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminMovieController;

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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('movies',[MovieController::class, 'index']);

Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
Route::get('admin/movies/create', [AdminMovieController::class, 'create']);
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('/admin/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
// Route::patch('/admin/movies/{movie}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::patch('/admin/movies/{movie}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::delete('admin/movies/{movie}/destroy', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
// Route::get('practice2', function() {
//     $test = 'practice2';
//     return response($test);
// });

// Route::get('practice3', function() {
//     return response('test');
// });
