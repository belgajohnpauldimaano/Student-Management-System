<?php

namespace App\Models;

use App\Traits\HasSchoolYear;
use App\Models\StudentInformation;
use Illuminate\Database\Eloquent\Model;

class IncomingStudent extends Model
{
    use HasSchoolYear;
    public function student()
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
    }

    public function studentEmail()
    {
        return $this->hasOne(StudentInformation::class, 'id','student_id');
    }

}