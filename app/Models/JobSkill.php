<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;

    protected $table = 'job_skill';

    protected $fillable = ['job_id', 'skill_id'];

    public $timestamps = true;
}
