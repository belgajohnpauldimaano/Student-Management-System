<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubjectDetail extends Model
{
    public function faculty()
    {        
        return $this->hasOne(FacultyInformation::class, 'id', 'faculty_id' );
    }
}
