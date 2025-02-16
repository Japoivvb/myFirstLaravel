<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    
    protected $table = 'job_listings';// to link model with table
    protected $fillable = ['name','email','title','salary'];// to list attributes allowed to be insert/update

    
    
}
