<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUser;

class FacultyInformation extends Model
{
    const DEPARTMENTS = [
        ['id' => 1, 'department_name' => 'Business'],
        ['id' => 2, 'department_name' => 'Voc Tech'],
        ['id' => 3, 'department_name' => 'English'],
        ['id' => 4, 'department_name' => 'Mathematics'],
        ['id' => 5, 'department_name' => 'Science'],
    ];

    use HasUser;

    protected $table = 'faculty_informations';

    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name',
        'address',
        'email',
        'contact_number',
        'photo',
        'user_id',
        'current',
        'status'
    ];
}
 