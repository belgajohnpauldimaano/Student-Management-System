<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StudentScholarType extends Model
{
    protected $fillable = [
        'student_information_id',
        'name'
    ];
}