<?php
namespace App\Traits;

use App\Models\Semester;

trait HasSemester{
    public function semester()
    {
        return $semester = Semester::whereCurrent(1)->first();
    }
}