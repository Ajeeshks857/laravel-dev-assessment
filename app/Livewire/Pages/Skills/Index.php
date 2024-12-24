<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Illuminate\Database\QueryException;
use Livewire\Component;

class Index extends Component
{
    public $skills;
    public $editingSkill = null;
    public $skillName;
    public $skillStatus;
    public $creatingSkill = false;

    public function mount()
    {
        try {
            $this->skills = Skill::all();
        } catch (QueryException $e) {
            session()->flash('error', 'Error loading skills: ' . $e->getMessage());
        }
    }

    public function editSkill($skillId)
    {
        try {
            $skill = Skill::find($skillId);

            if ($skill) {
                $this->editingSkill = $skill;
                $this->skillName    = $skill->name;
                $this->skillStatus  = $skill->status;
            }
        } catch (QueryException $e) {
            session()->flash('error', 'Error retrieving skill: ' . $e->getMessage());
        }
    }

    public function updateSkill()
    {
        try {
            $this->validate([
                'skillName'   => 'required|string|max:255',
                'skillStatus' => 'required|boolean',
            ]);

            $this->editingSkill->update([
                'name'   => $this->skillName,
                'status' => $this->skillStatus,
            ]);

            $this->skills = Skill::all();

            $this->resetEditingForm();
        } catch (QueryException $e) {
            session()->flash('error', 'Error updating skill: ' . $e->getMessage());
        }
    }

    public function resetEditingForm()
    {
        $this->editingSkill = null;
        $this->skillName    = '';
        $this->skillStatus  = 0;
    }

    public function deleteSkill($skillId)
    {
        try {
            $skill = Skill::find($skillId);
            if ($skill) {
                $skill->delete();
            }

            $this->skills = Skill::all();
        } catch (QueryException $e) {
            session()->flash('error', 'Error deleting skill: ' . $e->getMessage());
        }
    }

    public function createSkillForm()
    {
        $this->creatingSkill = true;
        $this->reset(['skillName', 'skillStatus']);
    }

    public function createSkill()
    {
        try {
            $this->validate([
                'skillName'   => 'required|string|max:255',
                'skillStatus' => 'required|boolean',
            ]);

            Skill::create([
                'name'   => $this->skillName,
                'status' => $this->skillStatus,
            ]);

            $this->skills = Skill::all();

            $this->creatingSkill = false;
        } catch (QueryException $e) {
            session()->flash('error', 'Error creating skill: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.skills.index');
    }
}
