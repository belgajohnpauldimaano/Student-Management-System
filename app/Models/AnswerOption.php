<?php

namespace App\Models;

use App\Traits\HasAssessments;
use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    protected $fillable = [
        'question_id',
        'option_title',
        'order_number'
    ];

    use HasAssessments;
}