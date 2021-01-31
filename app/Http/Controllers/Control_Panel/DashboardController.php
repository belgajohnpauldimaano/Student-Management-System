<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index () 
    {
        $StudentInformation_all = DB::table('student_informations')
            ->select(DB::raw('COUNT(id) as student_count'))
            ->where('status', 1)
            ->first();

        $StudentInformation_all_male = DB::table('student_informations')
            ->select(DB::raw('COUNT(id) as student_count'))
            ->where('gender', '=', 1)
            ->first();

        $StudentInformation_all_female = DB::table('student_informations')
            ->select(DB::raw('COUNT(id) as student_count'))
            ->where('gender', '=', 2)
            ->where('status', 1)
            ->first();

        $registrar = DB::table('registrar_informations')
            ->select(DB::raw('COUNT(id) as registrar_count'))
            ->where('status', 1)
            ->first();
        
        $faculty = DB::table('faculty_informations')
            ->select(DB::raw('COUNT(id) as faculty_count'))
            ->where('status', 1)
            ->first();

        $finance = DB::table('finance_informations')
            ->select(DB::raw('COUNT(id) as finance_count'))
            ->where('status', 1)
            ->first();
        $admission = DB::table('admission_informations')
            ->select(DB::raw('COUNT(id) as admission_count'))
            ->where('status', 1)
            ->first();

        $rooms = DB::table('rooms')
            ->select(DB::raw('COUNT(id) as rooms_count'))
            ->where('status', 1)
            ->first();
        // return json_encode(\Auth::user()->get_user_data());
        return view('control_panel.dashboard.index', compact('StudentInformation_all'
        ,'StudentInformation_all_male',
        'StudentInformation_all_female',
        'registrar',
        'faculty',
        'rooms',
        'finance',
        'admission'
        ));
    }
}