<?php
namespace App\Traits;

use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\SectionDetail;
use App\SubjectDetail;
use App\ClassSubjectDetail;
use App\FacultyInformation;
use App\StudentInformation;
use App\StudentEnrolledSubject;
use Illuminate\Support\Facades\Auth;

trait HasGradeSheet{   

    public function classDetail()
    {     
        return $this->hasMany(ClassDetail::class, 'id', 'class_details_id')
            ->whereStatus(1)->whereCurrent(1);
    }

    public function classSubjectDetail()
    {
        return $this->hasOne(ClassSubjectDetail::class, 'class_details_id', 'id')
            ->whereStatus(1)->where('class_subject_order', 'ASC');
    }

    public function class_subjects()
    {
        return $this->hasOne(ClassSubjectDetail::class, 'class_details_id', 'class_details_id')
            ->whereStatus(1)->where('class_subject_order', 'ASC');
    }

    public function grade(){
        return $this->hasOne(ClassDetail::class, 'id', 'grade_level');
    }

    public function section()
    {        
        return $this->hasOne(SectionDetail::class, 'id','section_id');
    }
    
    public function faculty()
    {        
        return $this->hasOne(FacultyInformation::class, 'id','faculty_id' );
    }

    public function subject()
    {        
        return $this->hasOne(SubjectDetail::class, 'id','subject_id');
    }

    public function enrollment()
    {        
        return $this->hasOne(Enrollment::class, 'id','enrollments_id');
    }

    public function student()
    {        
        return $this->hasOne(StudentInformation::class, 'student_information_id');
    }

    public function student_enrollment()
    {
        return $this->hasOne(Enrollment::class, 'class_details_id','id')->whereStatus(1);
    }
   
}