<?php

namespace App\Http\Controllers\Finance;

use App\SchoolYear;
use App\Transaction;
use App\PaymentCategory;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentPaymentController extends Controller
{
    public function index(Request $request){

        if ($request->ajax())
        {
            // $StudentInformation = StudentInformation::where('status', 1)
            //  ->where(function ($query) use ($request) {
            //      $query->where('first_name', 'like', '%'.$request->search.'%');
            //      $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
            //      $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            // })->get();

            $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->orderBY('id', 'DESC')
            ->first();

            $NotyetApproved = Transaction::with('student')->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)->where('approval', 'Not yet approved')
                    ->where('student_id', $StudentInformation->id)
                    ->paginate(10);

            $Approved = Transaction::where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)->where('approval', 'Approved')
                    ->paginate(10);

            return view('control_panel_finance.student_payment.partials.data_list', compact('NotyetApproved','Approved'));
        }  


        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->orderBY('id', 'DESC')
            ->first();

         

        $NotyetApproved = Transaction::where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)                
                ->where('approval', 'Not yet approved')
                ->paginate(10);

        $Approved = Transaction::where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)->where('approval', 'Approved')
                ->paginate(10);

        return view('control_panel_finance.student_payment.index', compact('NotyetApproved','Approved'));
    }

    public function approve(Request $request)
    {
        $Approve = \App\Transaction::where('id', $request->id)->first();

        if ($Approve)
        {
            $Approve->approval = 'Approved';
            $Approve->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Payment status successfully approved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function disapprove(Request $request)
    {
        $NotyetApproved = \App\Transaction::where('id', $request->id)->first();

        if ($NotyetApproved)
        {
            $NotyetApproved->approval = 'Not yet approved';
            $NotyetApproved->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Payment status successfully disapproved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
