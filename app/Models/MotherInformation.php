<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MotherInformation extends Model
{
    protected $fillable = [
        'student_information_id',
        'name',
        'occupation',
        'fb_acct',
        'number'
    ];
}