<?php

namespace App\Http\Controllers;

use App\Models\Strand;

use App\Models\Article;
use Illuminate\Http\Request;


class HomePageController extends Controller
{
    public function home_page (Request $request) {

       // $News_without_image = Article::with(
       //     ['user']
       // )->where('article_type', '=', 1)->get();
       
       $Article = Article::where('status', 1)->get()->take(3);
       

       // dd($Article);
       return view('welcome', [
           'Article'       => $Article,
       ]);
    }

    public function fetch_strand (Request $request)
    {
        $strands =  Strand::where('status', 1)->orderby('strand', 'desc')->get();


        $data = '<label for="">Strand </label>;
                    <select name="strand" id="strand" class="form-control form-control-sm">
                        <option value="0">Select Strand</option>';
        if (!$strands->isEmpty()) 
        {
            foreach ($strands as $strand) 
            {
                $data .= '
                    <option value="'. $strand->id .'">'. $strand->strand .'</option>
                ';
            }
        } 
        
        $data .='</select>
                    <div class="help-block text-red text-left" id="js-strand">
                    </div>';

        return $data;
    }
}