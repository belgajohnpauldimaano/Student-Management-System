<?php

namespace App\Models;

use App\Traits\HasAssessments;
use App\Traits\HasInstruction;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasInstruction, HasAssessments;
    
    protected $fillable = [
        'assessment_id',
        'question_type',
        'question_title'
    ];

    
}