<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateScheduleRequest;
use App\Models\Schedule;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        return view('admin.schedules.edit', compact('schedule','movie'));
    }

    public function update(CreateScheduleRequest $request, int $scheduleId)
    {
        log::info($request);

        // 日付と時刻を結合して比較
        $startTime = Carbon::parse($request['start_time_date'] . ' ' . $request['start_time_time']);
        $endTime = Carbon::parse($request['end_time_date'] . ' ' . $request['end_time_time']);

        //時刻の前後関係のバリデーション
        if ($startTime->greaterThan($endTime)) {
            return redirect()->back()->withErrors([
                'start_time_time' => '開始時間は終了時間より前に設定してください。',
                'end_time_time' => '終了時間は開始時間より後に設定してください。',
            ])->with('error', 'バリデーションエラーが発生しました。');
        }
        //時間の差のバリデーション
        if ($startTime->diffInMinutes($endTime) < 5) {
            return redirect()->back()->withErrors([
                'start_time_time' => '開始時間と終了時間の差は5分以上にしてください。',
                'end_time_time' => '開始時間と終了時間の差は5分以上にしてください。',
            ])->with('error', 'バリデーションエラーが発生しました。');
        }


        // スケジュール更新画面表示
        $schedule = Schedule::find($scheduleId);

        $schedule->start_time = $startTime;
        $schedule->end_time = $endTime;
        $schedule->save();

        return redirect()->route('admin.schedules.show', $schedule->id);
    }

    public function create(int $id)
    {
        // スケジュール登録画面表示
        $movie = Movie::find($id);
        return view('admin.movies.schedules.create', compact('movie'));
    }

    public function store(CreateScheduleRequest $request, int $id)
    {

        $startTime = Carbon::parse($request->input('start_time_date') . ' ' . $request->input('start_time_time'));
        $endTime = Carbon::parse($request->input('end_time_date') . ' ' . $request->input('end_time_time'));

        if ($startTime->gte($endTime)) {
            return redirect()->back()->withErrors([
                'start_time_time' => '開始時間は終了時間より前に設定して下さい。',
                'end_time_time' => '終了時間は開始時間より後に設定して下さい。',
            ]);
        }

        $diffInMinutes = $endTime->diffInMinutes($startTime);

        if ($diffInMinutes < 5) {
            return redirect()->back()->withErrors([
                'start_time_time' => '開始時間と終了時間の差は5分以上にしてください。',
                'end_time_time' => '開始時間と終了時間の差は5分以上にしてください。',
            ])->with('error', 'バリデーションエラーが発生しました。');
        }

        $schedule = new Schedule();
        $schedule->movie_id = $id;
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
