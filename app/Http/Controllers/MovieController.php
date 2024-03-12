<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieController extends Controller
{
    // use HasFactory;

    public function index(Request $request) {
        // $movies = Movie::all();
         // クエリパラメータの取得
    // $isShowing = $request->query('is_showing');
    // $keyword = $request->query('keyword');

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

    // 公開中/公開予定の絞り込み
    // if ($isShowing !== null) {
    //     $query->where('is_showing', $isShowing);
    // }

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
        // return view('movies', compact('movies'));
    }
}
