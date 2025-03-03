<?php

use App\Models\Employer;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Symfony\Contracts\Service\Attribute\Required;

Route::get('/', function () {
    return view('home',  ['greeting' => 'Hello']); // pass data to view getting from $greeting
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Index
Route::get('/jobs', function () {

    // $jobs = Job::with('employer')->get();// fix problem N+1 query with relationship
    $jobs = Job::with('employer')->latest()->paginate(3); // to do pagination

    return view('jobs.index', [
        'jobs' => $jobs
    ]); // pass data to view getting from $greeting
})->name('jobs');

// Create 
Route::get('jobs/create', function () {
    return view('jobs.create');
});
// Store
Route::post('jobs', function () {
    // validate data
    request()->validate([
        'username' => ['required', 'min:3'],
        'usermail' => ['required'],
        'title' => ['required'],
        'salary' => ['required']
    ]); // if any error return to form with $errors informed    

    // insert new job
    Job::create([
        'name' => request('username'),
        'email' => request('usermail'),
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    //$jobs = Job::all();    
    //$job = collect($jobs)->firstWhere('id', $id);
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'username' => ['required', 'min:3'],
        'usermail' => ['required'],
        'title' => ['required'],
        'salary' => ['required']
    ]);

    // TODO authorize the request 

    // update
    $job = Job::findOrFail($id); // to avoid get a null from database

    // insert new job
    $job->update([
        'name' => request('username'),
        'email' => request('usermail'),
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // redirect
    return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {
    // authorize request 
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs/');
});


