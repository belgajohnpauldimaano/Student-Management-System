<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingStudent extends Model
{
    public function student()
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
    }
}
