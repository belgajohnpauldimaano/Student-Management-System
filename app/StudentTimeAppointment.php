<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTimeAppointment extends Model
{
    public function appointment() 
    {
        return $this->belongsTo(OnlineAppointment::class, 'online_appointment_id', 'id');
    }

    public function student() 
    {
        return $this->belongsTo(StudentInformation::class, 'student_id', 'id');
    }
}
