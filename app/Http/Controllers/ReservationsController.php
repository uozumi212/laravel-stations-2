<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Http\Requests\CreateReservationRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Screen;
use App\Models\Schedule;

class ReservationsController extends Controller
{
    public function create(Request $request, int $movieId, int $scheduleId)
    {
        $sheetId = $request->query('sheetId');
        $date = $request->query('date');

        if(!$sheetId || !$date){
            abort(400, '予約する座席と日付を指定してください。');
        }
        // dd($request->all());

        // $existingReservation = Reservation::where('schedule_id', $scheduleId)
        //     ->where('sheet_id', $sheetId)
        //     ->where('date', $date)
        //     ->first();
        $screens = Screen::all();

        // $existingReservation = Reservation::where('date', $date)
        //     ->where('sheet_id', $sheetId)
        //     ->where('schedule_id', $scheduleId)
        //     ->where('screen_id', $screens->pluck('id')->toArray())
        //     ->get();
        $availableScreen = null;

            for ($screen_id = 1; $screen_id <= 3; $screen_id++) {
                    $existingReservation = Reservation::where('schedule_id', $scheduleId)
                    ->where('sheet_id', $sheetId)
                    ->where('screen_id', $screen_id)
                    ->exists();
                if (!$existingReservation) {
                    $availableScreen = $screen_id;
                    break;
                }
            }

        if (!$availableScreen) {
            // return redirect()->back()->withInput()->with('error', 'この座席は既に予約されています。');
            abort(400, 'この座席は既に予約されています。');
        }



         return view('movies.schedules.reservations.create', compact('movieId', 'scheduleId', 'sheetId', 'date'));
    }

    public function store(CreateReservationRequest $request)
    {
        // dd($request->all());

        try {
            $schedule_id = $request->input('schedule_id');
            $sheet_id = $request->input('sheet_id');
            $movie_id = $request->input('movie_id');
            $date = $request->input('date');

            // $screen_id = Schedule::where('id', $schedule_id)->value('screen_id');

            //  $existingReservation = Reservation::where('schedule_id', $schedule_id)
            //     ->where('sheet_id', $sheet_id)
            //     ->where('screen_id', $screen_id)
            //     ->where('date', $date)
            //     ->first();


                    // dd($schedule_id);
                    // dd($sheet_id);
            $availableScreen = null;

            for ($screen_id = 1; $screen_id <= 3; $screen_id++) {
                    $existingReservation = Reservation::where('schedule_id', $schedule_id)
                    ->where('sheet_id', $sheet_id)
                    ->where('screen_id', $screen_id)
                    ->exists();
                if (!$existingReservation) {
                    $availableScreen = $screen_id;
                    break;
                }
            }
                        // dd($availableScreen);

            // dd($existingReservation);

            // $existingReservation = Reservation::where([
            //     'schedule_id' => $schedule_id,
            //     'sheet_id' => $sheet_id,
            //     'date' => $date,
            //     'screen_id' => $screen_id
            // ])->exists();

            // $existingReservation = Screen::whereDoesntHave('reservations', function ($query) use ($schedule_id, $sheet_id, $date) {
            //     $query->where('schedule_id', $schedule_id)
            //           ->where('sheet_id', $sheet_id)
            //           ->where('date', $date);
            // })->first();
            // dd($existingReservation);

        // if ($existingReservation) {
        //     // return redirect()->back()->withInput()->with('error', 'この座席は既に予約されています。');
        //     abort(400, 'この座席は既に予約されています。');
        // }

        if ($availableScreen) {
            $reservation = Reservation::create([
                'schedule_id' => $schedule_id,
                'sheet_id' => $sheet_id,
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'date' => $date,
                'screen_id' => $availableScreen,
        ]);

        return redirect()->route('movies.show', ['id' => $movie_id])->with('success', '予約が完了しました。');

    } else {
        return response()->json(['error' => '指定されたスケジュールと座席は全て予約済みです。'], 400);
    }

        } catch (\Exception $e) {
                Log::error('Reservation Error: ', ['exception' => $e]);
                    return redirect()->back()->with('error', '予約中にエラーが発生しました。');
        }
    }

}
