<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    // public function enrollment()
    // {
    //     return $this->belongsTo('App\Registration', 'regid', 'id');
    // }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }

    
}
