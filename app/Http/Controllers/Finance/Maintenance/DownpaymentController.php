<?php

namespace App\Http\Controllers\Finance\Maintenance;

use App\Models\GradeLevel;
use App\Models\DownpaymentFee;
use Illuminate\Http\Request;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class DownpaymentController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $NotyetApprovedCount = $this->notYetApproved();
            $DownpaymentFee = DownpaymentFee::where('status', 1)->where('downpayment_amt', 'like', '%'.$request->search.'%')
                ->orderBY('grade_level_id', 'ASC')
                ->paginate(10);
            return view('control_panel_finance.maintenance.downpayment.partials.data_list', compact('DownpaymentFee','NotyetApprovedCount'))->render();
        }
        
        $NotyetApprovedCount = $this->notYetApproved();
        $DownpaymentFee = DownpaymentFee::where('status', 1)
            ->orderBY('grade_level_id', 'ASC')
            ->paginate(10);
            
        return view('control_panel_finance.maintenance.downpayment.index', compact('DownpaymentFee','NotyetApprovedCount'));
    }

    public function modal_data (Request $request) 
    {
        $DownpaymentFee = NULL;
        if ($request->id)
        {
            $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();
        }
        $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        return view('control_panel_finance.maintenance.downpayment.partials.modal_data', compact('DownpaymentFee','Gradelvl'))->render();
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
            $DownpaymentFee->grade_level_id = $request->gradelvl;
            $DownpaymentFee->modified = $request->modified;
            $DownpaymentFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $DownpaymentFee = new DownpaymentFee();
        $DownpaymentFee->downpayment_amt = $request->downpayment_fee;
        $DownpaymentFee->grade_level_id = $request->gradelvl;
        $DownpaymentFee->modified = $request->modified;
        $DownpaymentFee->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function modify (Request $request)
    {
        $DownpaymentFee = DownpaymentFee::where('id', $request->id)->first();
        if ($DownpaymentFee) 
        {
            if ($DownpaymentFee->modified == 0) 
            {
                $DownpaymentFee->modified = 1; 
                $DownpaymentFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to modified.']);
            }
            else 
            {
                $DownpaymentFee->modified = 0; 
                $DownpaymentFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from modified.']);
            }
        }
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