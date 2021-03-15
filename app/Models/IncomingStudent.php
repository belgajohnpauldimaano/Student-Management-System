<?php

namespace App\Models;

use App\Models\StudentInformation;
use Illuminate\Database\Eloquent\Model;

class IncomingStudent extends Model
{
    public function student()
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
    }

    public function studentEmail()
    {
        return $this->hasOne(StudentInformation::class, 'id','student_id');
    }
}