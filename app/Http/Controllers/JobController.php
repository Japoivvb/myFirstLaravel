<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

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
        // dump and die
        //dd(request());
        // dump and continue
        //dump(request());
        // validate data
        request()->validate([
            'username' => ['required', 'min:3'],
            'usermail' => ['required'],
            'title' => ['required'],
            'salary' => ['required']
        ]); // if any error return to form with $errors informed    

        // insert new job
        $job = Job::create([
            'name' => request('username'),
            'email' => request('usermail'),
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        // send mail
        // Mail::to($job->employer->user->email)->send(new JobPosted($job));
        // send using queue
        Mail::to($job->employer->user->email)->queue(new JobPosted($job));

        return redirect('/jobs');
    }
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    public function edit(Job $job)
    {
        // authorize by employer user using gate
        Gate::authorize('edit-job',$job);
        
        // authorize by logged in
        if(Auth::guest()){
            return redirect('/login');
        }
        // authorize by employer user using Auth
        if($job->employer->user->isNot(Auth::user())){
            abort(403);
        }
        

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
