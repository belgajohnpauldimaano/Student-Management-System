<?php

namespace App\Http\Controllers\Finance\Maintenance;

use App\DiscountFee;
use Illuminate\Http\Request;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class SubsidyFeeController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $NotyetApprovedCount = $this->notYetApproved();
            $DiscountFee = DiscountFee::where('status', 1)
                ->where('disc_type', 'like', '%'.$request->search.'%')
                ->where('category', 0)
                ->paginate(10);
            return view('control_panel_finance.maintenance.subsidy.partials.data_list', compact('DiscountFee','NotyetApprovedCount'))->render();
        }

        $NotyetApprovedCount = $this->notYetApproved();
        
        $DiscountFee = DiscountFee::where('status', 1)
            ->where('category', 0)
            ->paginate(10);
        return view('control_panel_finance.maintenance.subsidy.index', compact('DiscountFee','NotyetApprovedCount'));
    }

    public function modal_data (Request $request) 
    {
        $DiscountFee = NULL;
        if ($request->id)
        {
            $DiscountFee = DiscountFee::where('id', $request->id)->where('category', 0)->first();
        }
        return view('control_panel_finance.maintenance.subsidy.partials.modal_data', compact('DiscountFee'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'disc_type' => 'required',
            'disc_fee' => 'required',
            'apply_to' => 'required'          
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $DiscountFee = DiscountFee::where('id', $request->id)->where('category', 0)->first();
            $DiscountFee->disc_type = $request->disc_type;
            $DiscountFee->disc_amt = $request->disc_fee;
            $DiscountFee->apply_to = $request->apply_to;
            $DiscountFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $DiscountFee = new DiscountFee();
        $DiscountFee->disc_type = $request->disc_type;
        $DiscountFee->disc_amt = $request->disc_fee;
        $DiscountFee->apply_to = $request->apply_to;
        $DiscountFee->category = 0;
        $DiscountFee->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function toggle_current_sy (Request $request)
    {
        $DiscountFee = DiscountFee::where('id', $request->id)->where('category', 0)->first();
        if ($DiscountFee) 
        {
            if ($DiscountFee->current == 0) 
            {
                $DiscountFee->current = 1; 
                $DiscountFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active Discount Fee.']);
            }
            else 
            {
                $DiscountFee->current = 0; 
                $DiscountFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active Discount Fee.']);
            }
        }
    }

    public function deactivate_data (Request $request) 
    {
        $DiscountFee = DiscountFee::where('id', $request->id)->where('category', 0)->first();

        if ($DiscountFee)
        {
            $DiscountFee->status = 0;
            $DiscountFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
