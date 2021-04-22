<?php

namespace App\Models;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;

class StudentExamDetails extends Model
{
    protected $fillable = [
        'time_start',
        'assessment_id',
        'student_information_id',
        'assessment_outcome',
        'score',
        'status'
    ];

    public function getStudentStatusAttribute()
    {
        $status = [
            '',
            'on-going', 
            'pending', 
            'done' 
        ];

        $color = [
            '',
            'success', 
            'info', 
            'danger' 
        ];
        return '<span class="badge bg-'.$color[$this->status].'">'.$status[$this->status].'</span>';
    }

    
}