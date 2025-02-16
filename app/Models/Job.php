<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {

    use HasFactory;// to use factory in order to add data
    
    protected $table = 'job_listings';// to link model with table
    protected $fillable = ['name','email','title','salary'];// to list attributes allowed to be insert/update

    
    
}
