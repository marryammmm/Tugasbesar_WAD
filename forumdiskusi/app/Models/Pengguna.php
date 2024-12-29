<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    public function forums()
    {
        return $this->hasMany(Forum::class, 'pengguna_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'pengguna_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'pengguna_id');
    }
}
