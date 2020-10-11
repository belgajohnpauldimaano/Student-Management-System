<?php

namespace App;

use App\Traits\HasGradeSheet;
use Illuminate\Database\Eloquent\Model;

class StudentEnrolledSubject extends Model
{
    use HasGradeSheet;
}