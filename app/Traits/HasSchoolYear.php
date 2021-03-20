<?php
namespace App\Traits;

use App\Models\SchoolYear;

trait HasSchoolYear{

    public function schoolYear()
    {
        return $this->hasOne(SchoolYear::class, 'id', 'school_year_id');
    }

    public function lastYear()
    {
        return $this->hasOne(SchoolYear::class, 'id', 'last_sy_attended');
    }

    public function schoolYears()
    {
        return SchoolYear::where('status', 1)->get();
    }
    
}