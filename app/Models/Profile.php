<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    // Each User has one Profile
    public function user(){
        return $this->belongsTo(related: User::class);
    }
}
