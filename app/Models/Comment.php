<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $fillable = ['habit_id', 'user_id', 'body'];

    
    public function habit() {
        return $this->belongsTo(Habit::class);
    
    }

    public function user() {
        return $this->belongsTo(User::class);
    
    }

}