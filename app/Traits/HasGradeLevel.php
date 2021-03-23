<?php
namespace App\Traits;

use App\Models\Semester;
use App\Models\Enrollment;

trait HasGradeLevel{
    
    public function gradeLevel()
    {
        return  Enrollment::with(['classDetail'])
                    ->whereStatus(1);
    }
}