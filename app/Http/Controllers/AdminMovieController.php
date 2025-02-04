<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class AdminMovieController extends Controller
{
    //
    public function index() {
         $movies = Movie::all();

        return view('admin.movies', compact('movies'));
    }

    public function show(int $id)
    {
        $movie = Movie::find($id);
        $schedules = $movie->schedules()->get();
        return view('admin.movies.show', compact('movie', 'schedules'));
    }

    public function create() {
        $genres = Genre::all();
        $movies = Movie::all();
        $errorMessage = session('error');
        $exceptionMessage = session('exceptionMessage');
        return view('admin.movies.create', compact('movies','genres', 'errorMessage', 'exceptionMessage'));
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



        try {

             DB::beginTransaction();
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


            // $movie->genres()->attach($genre->id);

            // $movie->genres()->attach($request->genre);

            DB::commit();

             return redirect('/admin/movies')->with('success', '映画が正常に登録されました');
        } catch (\Exception $e) {
            DB::rollback();
            // $errorMessage = $e->getMessage();
            $errorMessage = '映画の登録中にエラーが発生しました。';
            $exceptionMessage = $e->getMessage(); // 修正した箇所
            \Log::error('SQLエラー:' . $exceptionMessage); // 修正した箇所
            // return redirect('/admin/movies/create')->with('error', $errorMessage)->with('exceptionMessage', $exceptionMessage); // 修正した箇所
            return response()->json(['error' => '映画の登録中にエラーが発生しました'], 500);
        }

    }

    public function edit(Movie $movie) {
        $movie->genre = Genre::where('id', $movie->genre_id)->first();
        // dd($movie->genre->name);

        // $movies = Movie::all();
        $genres = Genre::all();
        // $genres = Genre::all()->first();
        if ($movie->genre_id) {
            $movie->genre = Genre::findOrFail($movie->genre_id);
        } else {
            $movie->genre = new Genre();
        }

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



        try {
            DB::beginTransaction();
            $is_showing = $request->has('is_showing') && $request->is_showing ? true : false;
            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);
            $genreId = $genre->id;

            // if($movie->genre !== null) {
            //     $reposense->assertSee($movie->genre->name);
            // }

            $movie->update([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'published_year' => $request->published_year,
                'is_showing' => $is_showing,
                'description' => $request->description,
                'genre_id' => $genre->id,
            ]);



            DB::commit();
            $movies = Movie::all();
            $genres = Genre::all();

            return redirect()->route('admin.movies.index',compact('movies', 'genres'))->with('success', '映画が正常に更新されました');
        } catch (\Exception $e) {
            DB::rollback();
            $exceptionMessage = $e->getMessage();
            \Log::error('映画の登録中にエラーが発生しました' . $exceptionMessage);
            // return redirect()->route('admin.movies.edit', $movie)->with('error', '映画の更新に失敗しました');
            // return redirect('admin/movies/create')->with('error', $errorMessage)->with('exceptionMesage', $exceptionMessage);
            // return redirect()->route('admin.movies.edit', $movie)->with('error', '映画の更新に失敗しました');
            return response()->json(['error' => '映画の更新中にエラーが発生しました'], 500);
        }
    }

    public function destroy(Movie $movie) {
        DB::beginTransaction();

        try {
            $movie->genres()->detach();
            $movie->delete();
            DB::commit();
            return redirect()->route('admin.movies.index')->with('success', "映画が削除されました");
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('映画の削除中にエラーが発生しました:', ['message' => $e->getMessage()]);
            return redirect()->route('admin.movies.index')->with('error', "映画の削除に失敗しました");
        }
    }
}
