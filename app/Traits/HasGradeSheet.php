<?php
namespace App\Traits;

use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\SectionDetail;
use App\SubjectDetail;
use App\FacultyInformation;
use App\StudentInformation;
use App\StudentEnrolledSubject;
use Illuminate\Support\Facades\Auth;

trait HasGradeSheet{   

    public function classDetail()
    {     
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first();   
        $sy_id = SchoolYear::whereCurrent(1)->whereStatus(1)->first();
        
        return $this->hasMany(ClassDetail::class, 'id', 'class_details_id')
            ->where('adviser_id', $FacultyInformation->id)
            ->where('status', '!=', 0)
            ->where('school_year_id', $sy_id->id);
    }

    public function grade(){
        return $this->hasOne(ClassDetail::class, 'id', 'class_details_id');
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
}