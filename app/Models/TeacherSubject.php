<?php

namespace App\Models;

use App\Models\FacultyInformation;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    public function faculty()
    {        
        return $this->hasOne(FacultyInformation::class, 'id', 'faculty_id' );
    }

    
}