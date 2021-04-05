<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Models\Semester;
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
        $semester = Semester::whereCurrent(1)->first()->id;
        return $this->hasMany(ClassSubjectDetail::class, 'class_details_id')
            ->where('status', '!=', 0)
            // ->where('sem', $semester)
            ->orderBy('class_subject_order', 'ASC');
    }

    public function classSubjects ()
    {
        $semester = Semester::whereCurrent(1)->first()->id;
        
        $query = $this->hasMany(ClassSubjectDetail::class, 'class_details_id')
            ->where('status', '!=', 0)
            ->orderBy('class_subject_order', 'ASC');
            
        if($this->grade_level > 10)
        {
            $query->where('sem', $semester);
        }
        return $result = $query;;
    }

    public function section (){
        return $this->hasOne(SectionDetail::class, 'id', 'section_id');
    }
}