<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Reservation;
use App\Models\Screen;

class SheetsController extends Controller
{
    //
    public function index(){
        $sheets = Sheet::all();
        return view('sheets',compact('sheets'));
    }

    public function movieSheets(Request $request, int $movie_id, int $scheduleId){

        $date = $request->query('date');
        // $date = now();
        if (!$date) {
            abort(400, '日付が指定されていません。');
        }

        if (!Movie::find($movie_id) || !Schedule::find($scheduleId)) {
            return response()->json(['error' => 'Movie or Schedule not found'], 404);
        }

        $schedules = Schedule::where('movie_id', $movie_id)->orderBy('start_time', 'asc')->get();

        if ($schedules->isEmpty()) {
            return response()->json(['error' => 'No schedules found for the movie'], 404);
        }

        $sheets = Sheet::limit(15)->get();

        $screens = Screen::all();

        $reservations = Reservation::where('date', $date)
            ->where('schedule_id', $scheduleId)
            ->get()
            ->groupBy(function ($reservation) {
                return $reservation->sheet_id;
            });

            // dd($reservations);

        // $existing_reservations = Reservation::where('date', $date)
        //     ->where('schedule_id', $schedule_id)
        //     ->get()
        //     ->keyBy('sheet_id');
        // dd($existing_reservations);


        return view('movies.schedules.sheets',compact('sheets', 'date', 'movie_id', 'scheduleId', 'reservations', 'screens'));
    }
}
