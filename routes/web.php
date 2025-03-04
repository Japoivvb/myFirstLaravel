<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
});


Route::controller(JobController::class)->group(function(){
    // Route::get('/jobs', 'index')->name('jobs');
    Route::get('jobs/create',  'create');
    Route::post('jobs',  'store');
    Route::get('/jobs/{job}',  'show');
    Route::get('/jobs/{job}/edit',  'edit');
    Route::patch('/jobs/{job}',  'update');
    Route::delete('/jobs/{job}',  'destroy');
})->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
