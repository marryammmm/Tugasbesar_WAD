<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'pengguna_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }


    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    
}
