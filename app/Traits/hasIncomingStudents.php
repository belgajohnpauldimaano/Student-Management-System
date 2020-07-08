<?php
namespace App\Traits;

use App\IncomingStudent;

trait hasIncomingStudents{
    public function IncomingStudentCount(){
        $IncomingStudentCount = IncomingStudent::where('approval', 'Not yet Approved')->count();
        return $IncomingStudentCount;
    }
}