<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
     public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $Article = \App\Article::where('status', 1)->paginate(10);
            return view('control_panel.articles.partials.data_list', compact('Article'))->render();
        }
        $Article = \App\Article::where('status', 1)->paginate(10);
        return view('control_panel.articles.index', compact('Article'));
    }
    
    public function modal_data (Request $request) 
    {
        $Article = NULL;
        if ($request->id)
        {
            $Article = \App\Article::where('id', $request->id)->first();
        }
        return view('control_panel.articles.partials.modal_data', compact('Article'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'school_year' => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        // if ($request->id)
        // {
        //     $SchoolYear = \App\SchoolYear::where('id', $request->id)->first();
        //     $SchoolYear->school_year = $request->school_year;
        //     $SchoolYear->current = $request->current_sy;
        //     $SchoolYear->save();
        //     return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        // }

        $SchoolYear = new \App\SchoolYear();
        $SchoolYear->school_year = $request->school_year;
        $SchoolYear->current = $request->current_sy;
        $SchoolYear->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
}
