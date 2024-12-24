<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    protected $table = 'job_details';

    protected $fillable = ['title', 'company_name', 'skills', 'company_logo', 'description', 'location', 'experience', 'salary', 'extra_info', 'status'];
    protected $casts    = [
        'extra_info' => 'array',
    ];

    public $timestamps = true;
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill', 'job_id', 'skill_id');
    }
}
