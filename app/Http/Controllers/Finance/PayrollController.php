<?php

namespace App\Http\Controllers\Finance;

use App\Models\Payroll;
use Illuminate\Http\Request;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request)
    {
        // if ($request->ajax())
        // {
        //     $NotyetApprovedCount = $this->notYetApproved();
        //     $TuitionFee = TuitionFee::where('status', 1)->where('tuition_amt', 'like', '%'.$request->search.'%')->paginate(10);
        //     return view('control_panel_finance.maintenance.tuition_fee.partials.data_list', compact('TuitionFee','NotyetApprovedCount'))->render();
        // }

        $NotyetApprovedCount = $this->notYetApproved();
        $payroll = Payroll::where('status', 1)->where('payroll_date', 'like', '%'.$request->search.'%')->paginate(10);
        if($request->ajax())
        {
            return view('control_panel_finance.payroll.partials.data_list', compact('TuitionpayrollFee','NotyetApprovedCount'))->render();
        }

        return view('control_panel_finance.payroll.index', 
            compact('payroll','NotyetApprovedCount'));
    }

    public function modal_data (Request $request) 
    {
        $payroll = NULL;
        if ($request->id)
        {
            $payroll = Payroll::where('id', $request->id)->first();
        }
        return view('control_panel_finance.payroll.partials.modal_data', compact('payroll'))->render();
    }
}