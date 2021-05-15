<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SiblingInformation extends Model
{
    protected $fillable = [
        'student_information_id',
        'name',
        'grade_level_id'
    ];
}