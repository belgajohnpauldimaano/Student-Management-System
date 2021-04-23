<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;

trait HasImage{
    
    public function getPhotoProfileAttribute()
    {
        $imagePath = $this->photo ? 
            public_path('/img/account/photo/'. 
            $this->photo) ? asset('/img/account/photo/'. 
            $this->photo) : asset('/img/account/photo/blank-user.gif') : 
            asset('/img/account/photo/blank-user.gif');

        return  $imagePath;
    }
}