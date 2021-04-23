<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasImage;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use App\Models\ClassSubjectDetail;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\File;

class FacultyInformation extends Model
{
    use HasUser, HasImage;

    const DEPARTMENTS = [
        ['id' => 1, 'department_name' => 'Business'],
        ['id' => 2, 'department_name' => 'Voc Tech'],
        ['id' => 3, 'department_name' => 'English'],
        ['id' => 4, 'department_name' => 'Mathematics'],
        ['id' => 5, 'department_name' => 'Science'],
    ];

    protected $table = 'faculty_informations';

    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name',
        'address',
        'email',
        'contact_number',
        'photo',
        'user_id',
        'current',
        'status'
    ];

    public function subjectCount()
    {
        return $this->hasOne(ClassSubjectDetail::class, 'faculty_id', 'id')->count();
    }

    public function classDetail()
    {
        $SchoolYear = SchoolYear::where('current', 1)->first();        
        return $this->hasOne(ClassDetail::class, 'id', 'class_details_id')->whereStatus(1)
            ->whereSchoolYearId($SchoolYear->id)->first();
    }    

    
}

 