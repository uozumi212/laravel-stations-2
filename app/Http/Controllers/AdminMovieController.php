<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class AdminMovieController extends Controller
{
    //
    public function index() {
         $movies = Movie::all();
        return view('admin.movies', compact('movies'));
    }

    public function create() {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            // 'is_showing' => 'nullable|boolean',
            'is_showing' => 'required|boolean',
            'description' => 'required|string',
            // 'genre' => 'required|exists:genres,id',
            'genre' => 'required|string',
        ]);

        // $genreName = $request->input('genre');


        DB::beginTransaction();

        try {
            $is_showing = $request->has('is_showing') && $request->is_showing ? true : false;
            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);
            $movie = Movie::create([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'published_year' => $request->published_year,
                'is_showing' => $is_showing,
                'description' => $request->description,
                'genre_id' => $genre->id,
            ]);

            // $genreNames = explode(',', $request->input('genres'));
            // foreach ($genreNames as $genreName) {
            //     $genre = Genre::firstOrCreate(['name' => $genreName]);
            //     $movie->genres()->attach($genre->id);
            // }

            $movie->genres()->attach($genre->id);

            // $movie->genres()->attach($request->genre);

            DB::commit();

             return redirect('/admin/movies/create')->with('success', '映画が正常に登録されました');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/movies/create')->with('error', '映画の登録中にエラーが発生しました');
        }

    }

    public function edit(Movie $movie) {
        // $movie->genre = Genre::where('id', $movie->genre_id)->first();
        // dd($movie->genre->name);
        $genres = Genre::all();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie) {
        $request->validate([
            'title' => 'required|unique:movies,title,' . $movie->id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            // 'is_showing' => 'nullable|boolean',
            'is_showing' => 'required|boolean',
            'description' => 'required|string',
            //  'genre' => 'required|exists:genres,id',
            'genre' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $is_showing = $request->has('is_showing') && $request->is_showing ? true : false;
            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);
            $movie->update([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'published_year' => $request->published_year,
                'is_showing' => $is_showing,
                'description' => $request->description,
                'genre_id' => $genre->id,
            ]);

            $genreNames = explode(',', $request->input('genres'));
            $movie->genres()->detach();
            foreach ($genreNames as $genreName) {
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $movie->genres()->attach($genre->id);
            }

            DB::commit();

            return redirect()->route('admin.movies.edit', $movie)->with('success', '映画が正常に更新されました');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.movies.edit', $movie)->with('error', '映画の更新に失敗しました');
        }
    }

    public function destroy(Movie $movie) {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', "映画が削除されました");
    }
}