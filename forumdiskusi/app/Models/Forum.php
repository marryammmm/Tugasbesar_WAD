<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forums';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'judul',
        'deskripsi',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'created_by');
    }
}
