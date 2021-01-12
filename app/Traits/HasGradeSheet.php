<?php
namespace App\Traits;

use App\Models\Room;
use App\Models\Strand;
use App\Models\Enrollment;
use App\Models\ClassDetail;
use App\Models\SectionDetail;
use App\Models\SubjectDetail;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\Auth;

trait HasGradeSheet{   

    public function classDetail()
    {     
        return $this->hasOne(ClassDetail::class, 'id', 'class_details_id')
            ->whereStatus(1)->whereCurrent(1);
    }

    public function classSubjectDetail()
    {
        return $this->hasOne(ClassSubjectDetail::class, 'class_details_id', 'id')
            ->whereStatus(1);
            // ->where('class_subject_order', 'ASC');
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
        return $this->hasOne(SectionDetail::class, 'id','section_id')
            ->whereStatus(1);
    }
    
    public function faculty()
    {        
        return $this->hasOne(FacultyInformation::class, 'id','faculty_id' );
    }

    public function adviserData()
    {        
        return $this->hasOne(FacultyInformation::class, 'id','adviser_id' );
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
        return $this->hasOne(StudentInformation::class, 'id','student_information_id')
            ->orderBY('last_name', 'ASC');
    }

    public function student_enrollment()
    {
        return $this->hasOne(Enrollment::class, 'class_details_id','id')->whereStatus(1);
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id','room_id');
    }

    public function strand()
    {
        return $this->hasOne(Strand::class, 'id','strand_id');
    }
   
}