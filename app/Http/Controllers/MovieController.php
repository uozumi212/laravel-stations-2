<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieController extends Controller
{
    // use HasFactory;

    public function index(Request $request) {

    // データベースから映画リストを取得
    $query = Movie::query();

    //公開状況で絞り込み
    if ($request->has('is_showing')) {
        $isShowing = $request->input('is_showing');
        if ($isShowing === '1') {
            $query->where('is_showing', true);
        } elseif ($isShowing === '0') {
            $query->where('is_showing', false);
        } elseif ($isShowing === 'all') {

        } else {

        }
    }

    // キーワードによる絞り込み
    if ($request->has('keyword')) {
        $keyword = $request->input('keyword');
        $query->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    // ページネーション
    $movies = $query->paginate(20);

    return view('movies.index', compact('movies'));
    }

    public function show(int $id) {
        $movie = Movie::find($id);
        $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get();
        return view('movies.show', compact('movie', 'schedules'));
    }
}
