<?php
namespace App\Traits;

use App\Models\Strand;
use App\Models\IncomingStudent;
use App\Models\StudentEducation;

trait HasAdmissions{
    
    public function incomingStudent()
    {
        return $this->hasOne(IncomingStudent::class, 'student_id', 'id');
    }

    public function studentEducation()
    {
        return $this->hasOne(StudentEducation::class, 'student_information_id', 'id');
    }

    public function getSchoolYearAttribute()
    {
        try {
            return $this->studentEducation->lastYear->school_year ? $this->studentEducation->lastYear->school_year : 'NA';
        } catch (\Throwable $th) {
            return 'NA';
        }
        
    }

    public function getAdmissionSchoolNameAttribute()
    {
        try {
            return $this->studentEducation->school_name ? $this->studentEducation->school_name : 'NA';
        } catch (\Throwable $th) {
            return 'NA';
        }
        
    }

    public function getAdmissionSchoolTypeAttribute()
    {
        try {
            return $this->studentEducation->school_type ? $this->studentEducation->school_type : 'NA';
        } catch (\Throwable $th) {
            return 'NA';
        }
        
    }

    public function getAdmissionSchoolAddressAttribute()
    {
        try {
            return $this->studentEducation->school_address ? $this->studentEducation->school_address : 'NA';
        } catch (\Throwable $th) {
            return 'NA';
        }
        
    }

    public function getAdmissionGwaAttribute()
    {
        try {
            return $this->studentEducation->gw_average ? $this->studentEducation->gw_average : 'NA';
        } catch (\Throwable $th) {
            return 'NA';
        }
        
    }

   
    public function getAdmissionStrandAttribute()
    {
        try {
            $strand = Strand::whereId($this->studentEducation->strand)->first()->strand;
            return $strand;
        } catch (\Throwable $th) {
            return 'NA';
        }
    }

    public function getAdmissionSyAttribute()
    {
        try {
            $sy = $this->incoming_student->schoolYear->school_year;
            return $sy;
        } catch (\Throwable $th) {
            return $this->incomingStudent->schoolYear->school_year;
        }
    }

}