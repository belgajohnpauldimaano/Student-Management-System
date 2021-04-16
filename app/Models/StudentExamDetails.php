<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamDetails extends Model
{
    protected $fillable = [
        'student_information_id',
        'assessment_id',
        'time_start',
        'student_information_id',
        'assessment_outcome',
        'status'
    ];

    public function getStudentStatusAttribute()
    {
        $status = [
            '',
            'on-going', 
            'published', 
            'archived' 
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