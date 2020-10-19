<?php

namespace App;

use App\SectionDetail;
use App\Traits\HasUser;
use App\ClassSubjectDetail;
use App\Traits\HasGradeSheet;
use App\Traits\HasSchoolYear;
use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    use HasGradeSheet, HasSchoolYear, HasUser;
    
    public function class_subjects ()
    {
        return $this->hasMany(ClassSubjectDetail::class, 'class_details_id', 'id')->where('status', '!=', 0);
    }

    public function section (){
        return $this->hasOne(SectionDetail::class, 'id', 'section_id');
    }
}