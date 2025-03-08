<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    //
    use HasFactory;// to use factory in order to add data

    public function jobs(){ // plural 1 to n
        return $this->hasMany(Job::class); // 1 employer has n jobs
    }
    public function user(){ // singular 1 to 1
        return $this->belongsTo(User::class); // 1 employer belongs to 1 user
    }
}
