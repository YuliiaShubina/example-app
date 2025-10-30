<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;

     protected $fillable = ['name', 'email', 'password'];

     // One User has One Profile
     public function profile(){
        return $this->hasOne(Profile::class);
     }

     // One user has many habits
    public function habits() {
        return $this->hasMany(Habit::class);
    }
}
