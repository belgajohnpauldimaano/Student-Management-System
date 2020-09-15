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
        return ucfirst($this->last_name) . ', ' . ucfirst($this->first_name). ' ' . ucfirst($this->middle_name);
    }
}
