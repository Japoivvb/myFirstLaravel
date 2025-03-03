<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        // $jobs = Job::with('employer')->get();// fix problem N+1 query with relationship
        $jobs = Job::with('employer')->latest()->paginate(3); // to do pagination

        return view('jobs.index', [
            'jobs' => $jobs
        ]); // pass data to view getting from $greeting

    }
    public function create()
    {
        return view('jobs.create');
    }
    public function store()
    {
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
    }
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }
    public function update(Job $job)
    {
        // TODO authorize the request 

        // validate
        request()->validate([
            'username' => ['required', 'min:3'],
            'usermail' => ['required'],
            'title' => ['required'],
            'salary' => ['required']
        ]);


        // update job
        $job->update([
            'name' => request('username'),
            'email' => request('usermail'),
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // redirect
        return redirect('/jobs/' . $job->id);
    }
    public function destroy(Job $job)
    {
        // TODO authorize request 
        $job->delete();
        return redirect('/jobs/');
    }
}
