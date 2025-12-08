<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model {
    use HasFactory;

    protected $fillable = ['goal', 'frequency', 'archived'];

    // Each habit belongs to one user
    public function user() {
        return $this->belongsTo(User::class);
    }

     public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function likedbyUser() {
        return $this->belongsToMany(Habit::class, 'likes');
    }
}
