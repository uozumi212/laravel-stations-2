<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = ['row', 'screen_id', 'column'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }
}
