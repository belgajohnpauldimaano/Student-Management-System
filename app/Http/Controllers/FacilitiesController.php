<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function facilities(){
        return view('pages.facilities.facilities');
    }
}
