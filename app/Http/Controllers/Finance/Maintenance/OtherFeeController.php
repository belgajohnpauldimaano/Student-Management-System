<?php

namespace App\Http\Controllers\Finance\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OtherFee;

class OtherFeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $OtherFee = \App\OtherFee::where('status', 1)->where('other_fee_name', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel_finance.maintenance.others_fee.partials.data_list', compact('OtherFee'))->render();
        }
        
        $OtherFee = \App\OtherFee::where('status', 1)->paginate(10);
        return view('control_panel_finance.maintenance.others_fee.index', compact('OtherFee'));
    }

    public function modal_data (Request $request) 
    {
        $OtherFee = NULL;
        if ($request->id)
        {
            $OtherFee = \App\OtherFee::where('id', $request->id)->first();
        }
        return view('control_panel_finance.maintenance.others_fee.partials.modal_data', compact('OtherFee'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'otherfee_name' => 'required',
            'other_fee' => 'required'         
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $OtherFee = OtherFee::where('id', $request->id)->first();
            $OtherFee->other_fee_name = $request->otherfee_name;
            $OtherFee->other_fee_amt = $request->other_fee;
            $OtherFee->current = $request->current;
            $OtherFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $OtherFee = new OtherFee();
        $OtherFee->other_fee_name = $request->otherfee_name;
        $OtherFee->other_fee_amt = $request->other_fee;
        $OtherFee->current = $request->current;
        $OtherFee->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function toggle_current_sy (Request $request)
    {
        $OtherFee = OtherFee::where('id', $request->id)->first();
        if ($OtherFee) 
        {
            if ($OtherFee->current == 0) 
            {
                $OtherFee->current = 1; 
                $OtherFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active Discount Fee.']);
            }
            else 
            {
                $OtherFee->current = 0; 
                $OtherFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active Discount Fee.']);
            }
        }
    }

    public function deactivate_data (Request $request) 
    {
        $OtherFee = \App\OtherFee::where('id', $request->id)->first();

        if ($OtherFee)
        {
            $OtherFee->status = 0;
            $OtherFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
