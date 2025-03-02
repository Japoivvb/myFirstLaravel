<?php

use App\Models\Employer;
use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {
    return view('home',  ['greeting' => 'Hello']); // pass data to view getting from $greeting
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs', function () {

    // $jobs = Job::with('employer')->get();// fix problem N+1 query with relationship
    $jobs = Job::with('employer')->latest()->paginate(3);// to do pagination

    return view('jobs.index', [
        'jobs' => $jobs
    ]); // pass data to view getting from $greeting
})->name('jobs');

Route::get('jobs/create' , function() {
    return view('jobs.create');
});
Route::post('jobs' , function() {
    // dd("hello from post");
    Job::create([
        'name' => request('username'),
        'email' => request('usermail'),
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function ($id) {
    //$jobs = Job::all();    
    //$job = collect($jobs)->firstWhere('id', $id);
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
