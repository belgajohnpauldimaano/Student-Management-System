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
use App\Models\StudentEnrolledSubject;

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
        return $this->belongsTo(SectionDetail::class, 'class_details')
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

    public function classSubject()
    {        
        return $this->hasOne(SubjectDetail::class, 'id','subject_id')->whereStatus(1);
    }

    public function enrollment()
    {        
        return $this->hasOne(Enrollment::class, 'id','enrollments_id');
    }

    public function student()
    {        
        return $this->hasOne(StudentInformation::class, 'id','student_information_id')->orderBy('last_name')->whereStatus(1);
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

    public function studentEnrolledSubject(){
        return $this->hasOne(StudentEnrolledSubject::class, 'class_subject_details_id', 'class_subject_details_id');
    }

    private function enrollmentInfo($id, $assessment_id)
    {
        $student = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('assessments', 'assessments.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->select(
                'student_informations.id as student_information_id', 
                'student_informations.first_name', 'student_informations.middle_name', 'student_informations.last_name',
                'student_informations.gender', 'student_informations.status', 
                'enrollments.id', 'enrollments.class_details_id'
            )
            ->with('faculty')
            ->orderBy('student_informations.last_name', 'ASC')
            ->where('assessments.id', $assessment_id)
            ->where('class_subject_details.id', $id)
            ->where('enrollments.status', 1)
            ->where('student_informations.status', 1);
            
        return $student;        
    }

    public function getSeniorFinalAveAttribute()
    {
        return $this->general_avg;
    }

}