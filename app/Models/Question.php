<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'assessment_id',
        'question_type',
        'question_title'
    ];

    public function answerMultipleChoice(){
        return $this->hasOne(QuestionAnswer::class, 'question_id');
    }

    public function options(){
        return $this->hasMany(AnswerOption::class, 'question_id')->orderBy('order_number', 'ASC');
    }
}