<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home',  ['greeting' => 'Hello']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard', ['greeting' => Auth::user()->name]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::view('/about', 'about');
    Route::view('/contact', 'contact');
});

Route::controller(JobController::class)->group(function(){
    Route::get('/jobs', 'index')->name('jobs');
    Route::get('jobs/create',  'create');
    Route::post('jobs',  'store');
    Route::get('/jobs/{job}',  'show');
    Route::get('/jobs/{job}/edit',  'edit')->middleware('can:edit-job,job');
    Route::patch('/jobs/{job}',  'update');
    Route::delete('/jobs/{job}',  'destroy');
})->middleware(['auth', 'verified']);// access only in case siggned in

Route::get('testMail', function(){
    //return new JobPosted(); to see content
    Mail::to('jose.portugal.ortuno@gmail.com')->send(new JobPosted());
    return 'Sent';
});

Route::get('testQueue', function(){
    // send message to a log using a queue
    dispatch(function(){
        logger('hello from the queue');
    });
    return 'Queue done';
});

Route::get('testJob', function(){
    // send message to a log using a job
    TranslateJob::dispatch();
    return 'Job done';
});
require __DIR__.'/auth.php';
