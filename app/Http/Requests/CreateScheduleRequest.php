<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'movie_id' => '映画',
            'screen_id' => 'スクリーン',
            'start_time_date' => '開始日',
            'start_time_time' => '開始時刻',
            'end_time_date' => '終了日',
            'end_time_time' => '終了時刻',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
  public function rules()
{
    return [
        'movie_id' => ['required'],
        'screen_id' => ['required'],
        'start_time_date' => [
            'required',
            'date_format:Y-m-d',
            'before_or_equal:end_time_date'
        ],
        'start_time_time' => [
            'required',
            'date_format:H:i',
            'before:end_time_time',
            function ($attribute, $value, $fail) {
                try {
                    if(!preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
                        $fail('時刻の形式が正しくありません。');
                        return;
                    }
                    $startTime = Carbon::parse(request()->start_time_time);
                    $endTime = Carbon::parse(request()->end_time_time);
                    $timeDifferenceInMinutes = $endTime->diffInMinutes($startTime);

                    if ($timeDifferenceInMinutes < 6) {
                        $fail('開始時間と終了時間の差は5分以上にしてください。');
                    }
                } catch (\Exception $e) {
                    $fail('日時の形式が正しくありません。');
                }
            },
        ],
        'end_time_date' => [
            'required',
            'date_format:Y-m-d',
            'after_or_equal:start_time_date'
        ],
        'end_time_time' => [
            'required',
            'date_format:H:i',
            'after:start_time_time',
            function ($attribute, $value, $fail) {
                try {
                    if(!preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
                        $fail('時刻の形式が正しくありません。');
                        return;
                    }
                    $startTime = Carbon::parse(request()->start_time_time);
                    $endTime = Carbon::parse(request()->end_time_time);
                    $timeDifferenceInMinutes = $endTime->diffInMinutes($startTime);

                    if ($timeDifferenceInMinutes < 6) {
                        $fail('開始時間と終了時間の差は5分以上にしてください。');
                    }
                } catch (\Exception $e) {
                    $fail('日時の形式が正しくありません。');
                }
            },
        ],
    ];
}
}
