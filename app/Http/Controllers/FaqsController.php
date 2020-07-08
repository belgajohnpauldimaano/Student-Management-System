<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function faqs(){
        return view('pages.faqs.faqs');
    }

    public function faqs_on_distance_learning(){
        return view('pages.faqs.faqs_on_distance_learning');
    }
}
