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
        'start_time', 'end_time', 'movie_id'
    ];

    protected $dates = [
        'start_time', 'end_time'
    ];

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id')->whereNotNull('schedules.id',);
    }
}
