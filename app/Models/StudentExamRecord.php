<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamRecord extends Model
{
    protected $fillable = [
        'student_information_id',
        'assessment_id',
        'question_id',
        'student_answer_option',
        'student_answer_option_status',
        'remarks'
    ];
}