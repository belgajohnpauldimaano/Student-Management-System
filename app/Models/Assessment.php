<?php

namespace App\Models;

use App\Traits\HasAssessments;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'class_subject_details_id',
        'title',
        'instructions',
        'period',
        'date_time_publish',
        'date_time_expiration',
        'semester',
        'quarter',
        'randomly_ordered',
        'time_limit',
        'total_items',
        'student_view_result',
        'student_no_attempts',
        'assessment_time',
        'attempt_limit'
    ];

    use HasAssessments;

    
}