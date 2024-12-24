<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobDetail;
use Livewire\Component;

class Index extends Component
{
    public $jobs = [];

    public function mount()
    {

        $jobsFromDb = JobDetail::with('skills')->get();

        $this->jobs = $jobsFromDb->map(function ($job) {
            return [
                "id"           => $job->id,
                "title"        => $job->title,
                "description"  => $job->description,
                "company_name" => $job->company_name,
                "company_logo" => asset('storage/' . $job->company_logo),
                "experience"   => $job->experience,
                "salary"       => $job->salary,
                "location"     => $job->location,
                "skills"       => $job->skills->pluck('name')->toArray(),
                "extra"        => json_decode($job->extra_info, true) ?? [],
            ];
        })->toArray();

    }
    public function deleteJob($jobId)
    {
        $job = JobDetail::findOrFail($jobId);
        $job->skills()->detach();
        $job->delete();
        $this->jobs = JobDetail::all();
        session()->flash('message', 'Job deleted successfully!');
    }
    public function render()
    {
        return view('livewire.pages.jobs.index', [
            'jobs' => $this->jobs,
        ]);
    }
}
