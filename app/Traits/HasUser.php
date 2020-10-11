<?php
namespace App\Traits;

use App\User;

trait HasUser{

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }    

   
}