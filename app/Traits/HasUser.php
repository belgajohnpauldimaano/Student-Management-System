<?php
namespace App\Traits;

use App\User;

trait HasUser{

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function getFullnameAttribute() {
    //     return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    // }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }    

   
}