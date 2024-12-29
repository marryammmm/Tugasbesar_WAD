<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo', 'distance_in_minutes'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
