<?php

namespace App;

use App\Traits\HasUser;
use App\Traits\HasGradeSheet;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectDetail extends Model
{
    use HasGradeSheet, HasUser;
}