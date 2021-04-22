<?php
namespace App\Traits;

use App\Models\Question;
use App\Models\Assessment;
use App\Models\Instruction;
use App\Models\AnswerOption;
use App\Models\QuestionAnswer;
use App\Models\StudentExamRecord;

trait HasInstruction{
    
    public function instructions(){
        return $this->morphMany(Instruction::class, 'instructionable');
    }

    public function answerMultipleChoice(){
        return $this->hasOne(QuestionAnswer::class, 'question_id');
    }

    public function answerMatching(){
        return $this->hasMany(QuestionAnswer::class, 'question_id');
    }

    public function options(){
        return $this->hasMany(AnswerOption::class, 'question_id')->orderBy('order_number', 'ASC');
    }

    public function studentAnswerRecord(){
        return $this->hasOne(StudentExamRecord::class, 'question_id', 'id')->orderBy('id', 'ASC');
    }

    public function questions(){
        
        $query = $this->hasMany(Question::class, 'assessment_id', 'instructionable_id')
            ->whereQuestionType($this->question_type)
            ->where('status', 1);

            $random = Assessment::whereId($this->instructionable_id)->first();
            
            if($random->randomly_ordered == 1){
                $query->inRandomOrder();
            }
        
        return $result = $query;
    }
    
}