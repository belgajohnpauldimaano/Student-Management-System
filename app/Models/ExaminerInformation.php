<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminerInformation extends Model
{
    protected $fillable = [
        'title',
        'examinerable_type',
        'examinerable_id'
    ];
}