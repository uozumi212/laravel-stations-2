<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminSchedulesController;
use App\Http\Controllers\SheetsController;

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

// 管理者用のルート
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
Route::get('admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
Route::get('/admin/movies/{id}', [AdminMovieController::class, 'show'])->name('admin.movies.show');
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('/admin/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
// Route::patch('/admin/movies/{movie}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::patch('/admin/movies/{movie}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::delete('admin/movies/{movie}/destroy', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');

// 管理者映画のスケジュール関連
Route::get('/admin/schedules', [AdminSchedulesController::class, 'index'])->name('admin.schedules.index');
Route::get('/admin/movies/{id}/schedules/create', [AdminSchedulesController::class, 'create'])->name('admin.movies.schedules.create');
Route::get('/admin/schedules/{scheduleId}/edit', [AdminSchedulesController::class, 'edit'])->name('admin.schedules.edit');
Route::patch('/admin/schedules/{scheduleId}/update', [AdminSchedulesController::class, 'update'])->name('admin.schedules.update');
Route::post('/admin/movies/{id}/schedules/store', [AdminSchedulesController::class, 'store'])->name('admin.schedules.store');
Route::get('/admin/schedules/{id}', [AdminSchedulesController::class, 'show'])->name('admin.schedules.show');
Route::delete('admin/schedules/{id}/destroy', [AdminSchedulesController::class, 'destroy'])->name('admin.schedules.destroy');


// 一般ユーザー用のルート
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/sheets', [SheetsController::class, 'index'])->name('sheets');
