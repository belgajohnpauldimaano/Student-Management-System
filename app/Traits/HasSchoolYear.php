<?php
namespace App\Traits;

use App\Models\SchoolYear;

trait HasSchoolYear{

    public function schoolYear()
    {
        return $this->hasOne(SchoolYear::class, 'id', 'school_year_id');
    }
    
}