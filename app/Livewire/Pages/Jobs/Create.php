<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobDetail;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title, $company_name, $company_logo, $description, $location, $experience, $salary, $extra_info;
    public $skills = [];
    public $allSkills;

    protected $rules = [
        'title'        => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'company_logo' => 'nullable|image|max:1024',
        'description'  => 'required|string',
        'location'     => 'required|string',
        'experience'   => 'required|string',
        'salary'       => 'required|string',
        'skills'       => 'required|array|min:1',
        'extra_info'   => 'required|string',
    ];

    public function mount()
    {
        // Fetch all skills
        $this->allSkills = Skill::all() ?? collect();

    }

    public function submit()
    {

        $this->validate();

        $logoPath = null;
        if ($this->company_logo) {
            $logoPath = $this->company_logo->store('logos', 'public');
        }
        $extraInfo = explode('/', $this->extra_info);

        $job = JobDetail::create([
            'title'        => $this->title,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
            'description'  => $this->description,
            'location'     => $this->location,
            'experience'   => $this->experience,
            'salary'       => $this->salary,
            'extra_info'   => json_encode($extraInfo),
        ]);

        $skillIds = array_map(function ($skill) {
            return (int) $skill;
        }, $this->skills);

        $job->skills()->attach($skillIds);

        $this->reset();
        session()->flash('message', 'Job posted successfully!');
        //return redirect()->route('admin.jobs.index');

    }
    public function destroy(JobDetail $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('message', 'Job deleted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
