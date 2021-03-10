<?php

namespace App\Http\Controllers;

use App\Models\Article;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\RegistrationButton;

class HomePageController extends Controller
{
     public function home_page (Request $request) {

        // $News_without_image = Article::with(
        //     ['user']
        // )->where('article_type', '=', 1)->get();
        
        $Article = Article::where('status', 1)->get()->take(3);
        $registration = RegistrationButton::whereId(1)->first()->is_enabled;
        $school_year =  SchoolYear::where('apply_to','!=',1)->first();

        // dd($Article);
        return view('welcome', [
            'Article'       => $Article,
            'registration'  => $registration,
            'school_year'   => $school_year
        ]);
     }
}