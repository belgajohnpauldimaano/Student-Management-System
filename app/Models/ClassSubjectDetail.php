<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasGradeSheet;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectDetail extends Model
{
    use HasGradeSheet, HasUser;

    public function teachersData(){
        return $this->hasMany(TeacherSubject::class, 'class_subject_details_id', 'id')->whereStatus(1);
    }
}