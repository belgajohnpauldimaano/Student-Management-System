<?php

namespace App\Http\Controllers\Finance\Maintenance;

use App\DownpaymentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownpaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $DownpaymentFee = DownpaymentFee::where('status', 1)->where('downpayment_amt', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel_finance.maintenance.downpayment.partials.data_list', compact('DownpaymentFee'))->render();
        }
        
        $DownpaymentFee = DownpaymentFee::where('status', 1)->paginate(10);
        return view('control_panel_finance.maintenance.downpayment.index', compact('DownpaymentFee'));
    }

    public function modal_data (Request $request) 
    {
        $DownpaymentFee = NULL;
        if ($request->id)
        {
            $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();
        }
        return view('control_panel_finance.maintenance.downpayment.partials.modal_data', compact('DownpaymentFee'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'downpayment_fee' => 'required'
           
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();
            $DownpaymentFee->downpayment_amt = $request->downpayment_fee;
            $DownpaymentFee->current = $request->current_sy;
            $DownpaymentFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $DownpaymentFee = new DownpaymentFee();
        $DownpaymentFee->downpayment_amt = $request->downpayment_fee;
        $DownpaymentFee->current = $request->current_sy;
        $DownpaymentFee->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function toggle_current_sy (Request $request)
    {
        $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();
        if ($DownpaymentFee) 
        {
            if ($DownpaymentFee->current == 0) 
            {
                $DownpaymentFee->current = 1; 
                $DownpaymentFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active Tuition Fee.']);
            }
            else 
            {
                $DownpaymentFee->current = 0; 
                $DownpaymentFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active Tuition Fee.']);
            }
        }
    }

    public function deactivate_data (Request $request) 
    {
        $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();

        if ($DownpaymentFee)
        {
            $DownpaymentFee->status = 0;
            $DownpaymentFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
