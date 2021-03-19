<?php

namespace App\Http\Controllers;

use App\Models\Strand;

use App\Models\Article;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Nullix\CryptoJsAes\CryptoJsAes;


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

    private function password()
    {
        return $password = encrypt("123456");
    }

    public function fetch_strand (Request $request)
    {
        $strands =  Strand::where('status', 1)->orderby('strand', 'desc')->get();

        // $data = '<label for="">Strand </label>;
        //             <select name="strand" id="strand" class="form-control form-control-sm">
        //                 <option value="0">Select Strand</option>';
        // if (!$strands->isEmpty()) 
        // {
        //     foreach ($strands as $strand) 
        //     {
        //         $data .= '
        //             <option value="'. $strand->id .'">'. $strand->strand .'</option>
        //         ';
        //     }
        // } 
        
        // $data .='</select>
        //             <div class="help-block text-red text-left" id="js-strand">
        //             </div>';
        $password = $this->password();

        // return $strands;
        return response()->json([
            'strands'       => CryptoJsAes::encrypt($strands, $password),
            'data'              => $password
        ], 200);
    }

    public function fetch_schoolyear(Request $request)
    {
        $school_year =  SchoolYear::where('status', 1)->latest()->first();
        $school_year_list =  SchoolYear::where('status', 1)
            ->select('id', 'school_year')
            ->orderby('id', 'desc')->get();
        
        $data='';
        foreach(json_decode($school_year['apply_to'], true) as $key => $item)
        {
            if($item['apply_name'] == 'registration')
            {
                $school_year_id = $item['is_apply'] == true ? $school_year->id : '0' ;
                $school_year = $item['is_apply'] == true ? $school_year->school_year : '0' ;
                $school_year_list = $item['is_apply'] == true ? $school_year_list : '0' ;
            }
        }

        $password = $this->password();
        
        return response()->json([
            'school_year'       => CryptoJsAes::encrypt($school_year,$password),
            'school_year_id'    => CryptoJsAes::encrypt($school_year_id,$password),
            'school_year_list'  => CryptoJsAes::encrypt($school_year_list,$password),
            'data'              => $password
        ], 200);
    }
}