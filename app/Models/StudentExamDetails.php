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
}