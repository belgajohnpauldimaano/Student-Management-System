<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GuardianInformation extends Model
{
    protected $fillable = [
        'student_information_id',
        'name',
        'occupation',
        'fb_acct',
        'number'
    ];
}