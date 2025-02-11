<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Schedule;
use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use Illuminate\Support\Facades\Log;

class AdminReservationsController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['schedule.movie', 'sheet'])
            ->where('date', '<', now())
            ->get();
        return view('admin.reservations', compact('reservations'));
    }

     public function create(Request $request)
    {

        // dd($request->all());
        $movies = Movie::all();
        $sheets = Sheet::all();
        $schedules = Schedule::all();

         return view('admin.reservations.create', compact('movies', 'schedules', 'sheets'));
    }

    public function store(CreateAdminReservationRequest $request)
    {
        // dd($request->all());

        try {
            $scheduleId = $request->input('schedule_id');
            $sheetId = $request->input('sheet_id');
            $movieId = $request->input('movie_id');
            $date = $request->input('date');

             $existingReservation = Reservation::where('schedule_id', $scheduleId)
                ->where('sheet_id', $sheetId)
                ->where('date', $date)
                ->first();

        if ($existingReservation) {
            // return redirect()->back()->withInput()->with('error', 'この座席は既に予約されています。');
            abort(400, 'この座席は既に予約されています。');
        }

        $reservation = Reservation::create([
            'schedule_id' => $scheduleId,
            'sheet_id' => $sheetId,
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'date' => $date,
            'screen_id' => random(1, 3),
        ]);

        return redirect()->route('admin.reservations')->with('success', '予約が完了しました。');
        } catch (\Exception $e) {
                Log::error('Reservation Error: ', ['exception' => $e]);
                    return redirect()->back()->with('error', '予約中にエラーが発生しました。');
        }
    }

    public function edit(int $id)
    {
        $reservation = Reservation::with(['schedule.movie', 'sheet'])->findOrFail($id);
        $movies = Movie::with('schedules')->get();
        $schedules = Schedule::with('movie')->get();
        $sheets = Sheet::all();
        return view('admin.reservations.edit', compact('reservation', 'movies', 'schedules', 'sheets'));
    }

    public function update(UpdateAdminReservationRequest $request, int $id)
    {

        // 重複チェック
        $existingReservation = Reservation::where('schedule_id', 'schedule_id')
            ->where('sheet_id', 'sheet_id')
            ->where('date', 'date')
            ->where('id', '<>', $id) // 自分自身は除外
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withInput()->withErrors(['error' => 'この座席は既に予約されています。']);
        }

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return redirect()->route('admin.reservations')->with('success', '予約情報を更新しました。');
    }

    public function destroy(int $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('admin.reservations')->with('success', '予約情報を削除しました。');
    }
}
