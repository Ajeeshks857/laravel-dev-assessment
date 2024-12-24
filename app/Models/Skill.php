<?php

namespace App\Models;

use App\Models\JobDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skills';

    protected $fillable = ['name', 'status'];

    public $timestamps = false;
    public function jobs()
    {
        return $this->belongsToMany(JobDetail::class, 'job_skill', 'skill_id', 'job_id');
    }
}
