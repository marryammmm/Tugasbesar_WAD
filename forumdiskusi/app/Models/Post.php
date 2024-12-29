<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'forum_id',
        'pengguna_id',
        'content',
        'created_at',
        'updated_at', 
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

}
