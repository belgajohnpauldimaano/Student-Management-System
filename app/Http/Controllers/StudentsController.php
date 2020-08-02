<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function students_organizations()
    {
    	return view('pages.students.students_organizations');
    }
    public function students_services()
    {
    	return view('pages.students.students_services');
    }
    public function students_services_development()
    {
    	return view('pages.students.student_services.student_development');
    }
    public function students_services_academic()
    {
    	return view('pages.students.student_services.academic_support');
    }
    public function publication()
    {
    	return view('pages.students.publication');
    }
    public function students_council()
    {
    	return view('pages.students.students_council');
    }
    public function students_handbook()
    {
    	return view('pages.students.students_handbook');
    }
}
