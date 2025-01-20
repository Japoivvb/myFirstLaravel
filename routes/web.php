<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home',  ['greeting' => 'Hello']); // pass data to view getting from $greeting
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@gmail.com'
            ],
            [
                'id' => 2,
                'name' => 'Lucy Lee',
                'email' => 'lucy@gmail.com'
            ],
            [
                'id' => 3,
                'name' => 'Ben Tex',
                'email' => 'ben@gmail.com'
            ]
        ]
    ]); // pass data to view getting from $greeting
})->name('jobs');

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ],
        [
            'id' => 2,
            'name' => 'Lucy Lee',
            'email' => 'lucy@gmail.com'
        ],
        [
            'id' => 3,
            'name' => 'Ben Tex',
            'email' => 'ben@gmail.com'
        ]
    ];
    
    $job = collect($jobs)->firstWhere('id', $id);
    // dd($job);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
