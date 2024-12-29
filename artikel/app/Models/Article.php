<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'image_url',
        'video_url',
    ];
}
