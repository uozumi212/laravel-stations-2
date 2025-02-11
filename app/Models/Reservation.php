<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'schedule_id',
        'sheet_id',
        'screen_id',
        'email',
        'name',
        'is_canceled',
    ];

    protected $uniqueKeys = [ 'schedule_id', 'sheet_id', 'screen_id'];

    public function sheet()
    {
        return $this->belongsTo(Sheet::class, 'sheet_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }
}
