<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schedule_id' => ['required'],
            'sheet_id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email:strict,dns'],
            'date' => ['required', 'date_format:Y-m-d']
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.required' => '予約するスケジュールを選択してください。',
            'sheet_id.required' => '予約する座席を選択してください。',
            'name.required' => '氏名を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'date.required' => '日付を入力してください。',
            'date.date_format' => '正しい日付を入力してください。',
        ];
    }
}
