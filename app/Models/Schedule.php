<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Movie;

class schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time', 'end_time', 'movie_id', 'screen_id',
    ];

    protected $dates = [
        'start_time', 'end_time'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id');
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }
}
