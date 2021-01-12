<?php
namespace App\Traits;

use App\Models\User;
use App\Models\FacultyInformation;
use Illuminate\Support\Facades\Auth;

trait HasUser{

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getFullNameAttribute() {
        return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    }

    public function getAdviserSignatureAttribute()
    {
        return ucwords($this->first_name. ' ' . $this->middle_name.' '.$this->last_name);
    }

    public function adviser()
    {
        return $this->hasOne(FacultyInformation::class, 'id', 'adviser_id');
    }

    public function isAdmin()
    {
        $isAdmin = Auth::user();
        return $isAdmin;
    }

    public function getLoginlinkAttribute(){
        $user = $this->hasOne(User::class, 'id', 'user_id')->first()->id;
        if($user){
            $url = config('autologin.prefix') . $user . config('autologin.suffix');
            return route('autologin', $url);  
        }else{
          return "#";
        }
    }   
}