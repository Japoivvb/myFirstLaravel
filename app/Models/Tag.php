<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function jobs(){ //plural 1 to n
        return $this->belongsToMany(Job::class, relatedPivotKey:"job_listing_id"); // 1 tag belongs to many tags
    }
}
