<?php

namespace App\Models;

use App\Traits\HasSchoolYear;
use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    use HasSchoolYear;
    
    protected $fillable = [
        'student_information_id', 
        'school_name', 
        'school_type',
        'school_address',
        'last_sy_attended',
        'gw_average',
        'strand',
        'is_transferee',
    ];
}