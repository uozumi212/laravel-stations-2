<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateScheduleRequest;
use App\Models\Schedule;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Screen;

class AdminSchedulesController extends Controller
{
    //
    public function index()
    {
        // スケジュール一覧表示
        $schedules = Schedule::all();
        $movies = Movie::with('schedules')->whereHas('schedules')->get();
        return view('admin.schedules', compact('schedules', 'movies'));
    }

    public function show(int $id)
    {
        $schedule = Schedule::find($id);
        $movie = Movie::find($schedule->movie_id);
        return view('admin.schedules.show', compact('schedule', 'movie'));
    }

    public function edit(int $id)
    {
        // スケジュール編集画面表示
        $schedule = Schedule::find($id);
        $movie = Movie::where('id', $schedule->movie_id)->first();
        $screens = Screen::all();
        return view('admin.schedules.edit', compact('schedule', 'movie', 'screens'));
    }

    public function update(CreateScheduleRequest $request, int $scheduleId)
    {

        // 日付と時刻を結合して比較
        $startTime = Carbon::parse($request['start_time_date'] . ' ' . $request['start_time_time']);
        $endTime = Carbon::parse($request['end_time_date'] . ' ' . $request['end_time_time']);

        // スケジュール更新画面表示
        $schedule = Schedule::find($scheduleId);

        $schedule->start_time = $startTime;
        $schedule->end_time = $endTime;
        $schedule->screen_id = $request['screen_id'];
        $schedule->save();

        return redirect()->route('admin.schedules.show', $schedule->id);
    }

    public function create(int $id)
    {
        // スケジュール登録画面表示
        $movie = Movie::find($id);

        $screens = Screen::all();
        return view('admin.movies.schedules.create', compact('movie', 'screens'));
    }

    public function store(CreateScheduleRequest $request, int $id)
    {

        // dd($request);
        $startTime = Carbon::parse($request->input('start_time_date') . ' ' . $request->input('start_time_time'));
        $endTime = Carbon::parse($request->input('end_time_date') . ' ' . $request->input('end_time_time'));


        // 時間の重複チェック
        // $existingSchedule = Schedule::where('screen_id', $request->input('screen_id'))
        //     ->where(function ($query) use ($startTime, $endTime) {
        //         $query->whereBetween('start_time', [$startTime, $endTime])
        //             ->orWhereBetween('end_time', [$startTime, $endTime]);
        //     })->first();

        // if ($existingSchedule) {
        //     throw new \InvalidArgumentException('指定された時間帯は既に予約されています');
        // }

        $schedule = new Schedule();
        $schedule->movie_id = $id;
        $schedule->screen_id = $request->input('screen_id');
        $schedule->start_time = $startTime;
        $schedule->end_time = $endTime;
        $schedule->save();
        return redirect()->route('admin.schedules.show', $schedule->id);
    }

    public function destroy(int $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
           abort(404);
        }
        $schedule->delete();
        return redirect()->route('admin.schedules.index');
    }
}
