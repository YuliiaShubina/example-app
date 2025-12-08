<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'habit_id'];

    // Each habit belongs to one user
    public function user() {
        return $this->belongsTo(User::class);
    }

     public function habit() {
        return $this->belongsTo(Habit::class);
    }
}
