<?php
namespace App\Traits;

use App\User;
use App\FacultyInformation;

trait HasUser{

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }

    public function adviser()
    {
        return $this->hasOne(FacultyInformation::class, 'id', 'adviser_id');
    }

   
}