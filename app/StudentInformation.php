<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function enrolled_class () 
    {
        return $this->hasMany(Enrollment::class, 'student_information_id', 'id');
    }

    public function transactions ()
    {
        return $this->hasOne(Transaction::class, 'student_id', 'id');
    }

    public function fullname()
    {
        return $this->last_name . ", " . $this->first_name;
    }
}
