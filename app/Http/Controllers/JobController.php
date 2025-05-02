<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

     // @desc    Show all job listings
    // @route   GET /jobs
     public function index(): View
    {
        $jobs = Job::latest()->paginate(9);
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */

     // @desc    Show create job form
    // @route   GET /jobs/create
    public function create(): View
    {
        return view('jobs.create');
    }

    // @desc    Save job to database
    // @route   POST /jobs
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote'=>'required|boolean',
            'requirements'=> 'nullable|string',
            'benefits'=>'nullable|string',
            'address'=>'required|string',
            'city'=>'required|string',
            'zipcode'=>'required|string',
            'contact_email'=>'required|string',
            'contact_phone'=>'nullable|string',
            'company_name'=>'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        if($request->hasFile('company_logo')){
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validatedData
            $validatedData['company_logo'] = $path;
        }

        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // @desc    Display a single job listing
    // @route   GET /jobs/{$id}
    public function show(Job $job)
    {
        return View('jobs.show')->with('job', $job);
    }

    // @desc    Show edit job form
    // @route   GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        //Checl=k if user is authorized
        $this->authorize('update', $job);

        return View('jobs.edit')->with('job', $job);
    }

     // @desc    Update job listing
    // @route   PUT /jobs/{$id}
    public function update(Request $request, Job $job)
    {
        //Checl=k if user is authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote'=>'required|boolean',
            'requirements'=> 'nullable|string',
            'benefits'=>'nullable|string',
            'address'=>'required|string',
            'city'=>'required|string',
            'zipcode'=>'required|string',
            'contact_email'=>'required|string',
            'contact_phone'=>'nullable|string',
            'company_name'=>'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        if($request->hasFile('company_logo')){
            // Delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validatedData
            $validatedData['company_logo'] = $path;
        }

        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    // @desc    Delete a job listing
    // @route   DELETE /jobs/{$id}
    public function destroy(Job $job): RedirectResponse
    {
        //Checl=k if user is authorized
        $this->authorize('delete', $job);

        if($job->company_logo){
            Storage::delete('public/logos/' . basename($job->company_logo));
        }
        $job->delete();

        //Check if the request came from dashboard
        if(request()->query('from') == 'dashboard'){
            return redirect()->route('dashboard')->with('success', 'Job deleted successfully.');
        }

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    //@desc searcch job listings
    //@route GET/jobs/search
    public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();
        if($keywords){
            $query->where(function($q) use ($keywords){
                $q->whereRaw('LOWER(title) like ?', ['%'. $keywords. '%'])
                ->orWhereRaw('LOWER(description) like ?', ['%'. $keywords. '%'])
                ->orWhereRaw('LOWER(tags) like ?', ['%'. $keywords. '%']);
            });
        }

        if($location){
            $query->where(function($q) use ($location){
                $q->whereRaw('LOWER(address) like ?', ['%'. $location. '%'])
                ->orWhereRaw('LOWER(city) like ?', ['%'. $location. '%'])
                ->orWhereRaw('LOWER(zipcode) like ?', ['%'. $location. '%']);
            });
        }

        $jobs = $query->paginate(12);

        return view('jobs.index')->with('jobs', $jobs);
    }
}
