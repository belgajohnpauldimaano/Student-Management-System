<?php
namespace App\Traits;

use App\Models\ExaminerInformation;
use Illuminate\Support\Facades\Auth;

trait HasExaminerDetails{
    
    public function examiner()
    {
        return ExaminerInformation::where('user_id', Auth::user()->id)->first();
    }
}