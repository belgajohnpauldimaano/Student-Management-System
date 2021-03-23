<?php
namespace App\Traits;

use App\Models\StudentInformation;
use Illuminate\Support\Facades\Auth;

trait HasStudentDetails{
    
    public function student()
    {
        return StudentInformation::where('user_id', Auth::user()->id)->first();
    }
}