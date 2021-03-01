<?php
namespace App\Traits;

use App\Models\Question;
use App\Models\Instruction;
use App\Models\AnswerOption;
use App\Models\QuestionAnswer;

trait HasInstruction{
    
    public function instructions(){
        return $this->morphMany(Instruction::class, 'instructionable');
    }

    public function answerMultipleChoice(){
        return $this->hasOne(QuestionAnswer::class, 'question_id');
    }

    public function options(){
        return $this->hasMany(AnswerOption::class, 'question_id')->orderBy('order_number', 'ASC');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'assessment_id', 'instructionable_id')
            ->whereQuestionType($this->question_type)->where('status', 1);
    }
}