<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model {
    use HasFactory;

    protected $fillable = ['goal', 'frequency', 'archived', 'user_id', 'image_path'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
