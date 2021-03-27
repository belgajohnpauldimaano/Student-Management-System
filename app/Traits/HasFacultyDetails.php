<?php
namespace App\Traits;

use App\Models\FacultyInformation;
use Illuminate\Support\Facades\Auth;

trait HasFacultyDetails{
    
    public function faculty()
    {
        return FacultyInformation::where('user_id', Auth::user()->id)->first();
    }
}