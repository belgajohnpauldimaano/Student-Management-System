<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt;


class TranscriptArchiveController extends Controller
{
    public function index (Request $request) 
    {
        
        return view('control_panel.transcript_archieve.index');
    }
    public function modal_data (Request $request)
    {
        $FacultyInformation = [];
        // return view('control_panel.transcript_archieve.partials.modal_data', compact('FacultyInformation'))->render();
        return view('control_panel.transcript_archieve.partials.modal_data_tor_uploader', compact('FacultyInformation'))->render();
    }
    public function save_transcript (Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'school_year_graduated' => 'required',
        ];
        $messages = [
            'first_name.required' => 'First name is required.',
            'middle_name.required' => 'Middle name is required',
            'last_name.required' => 'Last name is required',
            'school_year_graduated.required' => 'School year graduated is required',
        ];

        $Validator = \Validator::make($request->all(), $rules, $messages);
        
        if ($Validator->fails()) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Something wrong in saving data', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id) {
            // $rules = [
            //     'tor' => 'size:2048|mime:xlsx'
            // ];
            // $messages = [
            //     'tor.mime' => 'PDF file type is the only accepted type.',
            //     'tor.size' => 'File size should be not more than 2MB.'
            // ];

            // $Validator = \Validator::make($request->all(), $rules, $messages);
            
            // if ($Validator->fails()) 
            // {
            //     return response()->json(['res_code' => 1, 'res_msg' => 'Something wrong in saving data', 'res_error_msg' => $Validator->getMessageBag()]);
            // }
        }

        
        $rules = [
            'tor' => 'required|max:2048'
        ];
        $messages = [
            'tor.required' => 'TOR is required.',
            'tor.mimetypes' => 'Excel file(xlsx) type is the only accepted type.',
            'tor.max' => 'File size should be not more than 2MB.'
        ];

        $Validator = \Validator::make($request->all(), $rules, $messages);
        
        if ($Validator->fails()) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Something wrong in saving data', 'res_error_msg' => $Validator->getMessageBag()]);
        }
        $file_name = base64_encode(date('U') . '-'. $request->last_name .'-'. $request->first_name .'-'. $request->middle_name . '-' . $request->school_year_graduated.'.'.$request->tor->getClientOriginalExtension());
        $request->tor->move(public_path('data\files'), $file_name);
        
        $TrascriptArhieve = new \App\TrascriptArhieve();
        $TrascriptArhieve->first_name           = $request->first_name;
        $TrascriptArhieve->middle_name          = $request->middle_name;
        $TrascriptArhieve->last_name            = $request->last_name;
        $TrascriptArhieve->school_year_graduated= $request->school_year_graduated;
        $TrascriptArhieve->file_name            = encrypt($file_name);
        $TrascriptArhieve->save();
        return json_encode($TrascriptArhieve);
    }
}
