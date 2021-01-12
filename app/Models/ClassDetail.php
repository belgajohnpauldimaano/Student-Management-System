<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Models\SectionDetail;
use App\Traits\HasGradeSheet;
use App\Traits\HasSchoolYear;
use App\Models\ClassSubjectDetail;
use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    use HasGradeSheet, HasSchoolYear, HasUser;
    
    public function class_subjects ()
    {
        return $this->hasMany(ClassSubjectDetail::class, 'class_details_id')->where('status', '!=', 0);
    }

    public function section (){
        return $this->hasOne(SectionDetail::class, 'id', 'section_id');
    }
}