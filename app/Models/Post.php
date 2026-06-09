<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'job_title', 'job_level',
        'vacancy_count', 'employment_type',
        'job_location', 'salary', 'deadline',
        'education_level', 'experience',
        'skills', 'specifications'
    ];

    //user post piviot for savedJobs
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function deadlineTimestamp()
    {
        return Carbon::parse($this->deadline)->timestamp;
    }

    public function remainingDays()
    {
        return max(0, Carbon::now()->startOfDay()->diffInDays(Carbon::parse($this->deadline)->startOfDay(), false));
    }

    public function getSkills()
    {
        return explode(',', $this->skills);
    }
}
