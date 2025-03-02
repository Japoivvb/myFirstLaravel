<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {

    use HasFactory;// to use factory in order to add data
    
    protected $table = 'job_listings';// to link model with table
    protected $fillable = ['name','email','title','salary','employer_id'];// to list attributes allowed to be insert/update
    // protected $guarded = []; to disable protection on fields
    
    public function employer(){ //singular 1 to 1
        return $this->belongsTo(Employer::class); // 1 job belongs to 1 employer
    }
    public function tags(){ //plural n to m
        return $this->belongsToMany(Tag::class, foreignPivotKey:"job_listing_id"); // 1 job has many tags // define id in pivot table
    }
    
}
