<?php


use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {
    return view('home',  ['greeting' => 'Hello']); // pass data to view getting from $greeting
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]); // pass data to view getting from $greeting
})->name('jobs');

Route::get('/jobs/{id}', function ($id) {
    //$jobs = Job::all();    
    //$job = collect($jobs)->firstWhere('id', $id);
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
