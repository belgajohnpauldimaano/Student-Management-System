<?php

namespace App;

use App\SectionDetail;
use App\ClassSubjectDetail;
use App\Traits\HasGradeSheet;
use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    use HasGradeSheet;
    
    public function class_subjects ()
    {
        return $this->hasMany(ClassSubjectDetail::class, 'class_details_id', 'id')->where('status', '!=', 0);
    }

    public function section (){
        return $this->hasOne(SectionDetail::class, 'id', 'section_id');
    }
}