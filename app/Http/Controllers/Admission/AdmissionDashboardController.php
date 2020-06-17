<?php

namespace App\Http\Controllers\Admission;

use Illuminate\Http\Request;
use App\Traits\hasIncomingStudents;
use App\Http\Controllers\Controller;

class AdmissionDashboardController extends Controller
{
    use hasIncomingStudents;

    public function index () 
    {
        $IncomingStudentCount = $this->IncomingStudentCount();

        $StudentInformation_all = \DB::table('student_informations')
            ->select(\DB::raw('COUNT(id) as student_count'))
            ->where('status', 1)
            ->first();

        $StudentInformation_all_male = \DB::table('student_informations')
            ->select(\DB::raw('COUNT(id) as student_count'))
            ->where('gender', '=', 1)
            ->first();

        $StudentInformation_all_female = \DB::table('student_informations')
            ->select(\DB::raw('COUNT(id) as student_count'))
            ->where('gender', '=', 2)
            ->where('status', 1)
            ->first();

        return view('control_panel_admission.dashboard.index',
            compact(
                'StudentInformation_all',
                'StudentInformation_all_male',
                'StudentInformation_all_female','IncomingStudentCount'
                )
        );
    }
}
