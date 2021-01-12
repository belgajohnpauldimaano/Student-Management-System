<?php

namespace App\Http\Controllers\Finance;

use Carbon\Carbon;
use App\Models\SchoolYear;
use Barryvdh\DomPDF\PDF;
use App\Models\FinanceInformation;
use App\Models\StudentInformation;
use Illuminate\Http\Request;
use App\Models\TransactionMonthPaid;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FinanceSummaryController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request)
    {
        $NotyetApprovedCount = $this->notYetApproved();
        $School_years = SchoolYear::where('status', 1)->orderBy('id', 'Desc')->get();
        return view('control_panel_finance.payment_summary.index', compact('NotyetApprovedCount','School_years'));
    }
    
    function fetch_record(Request $request)
    {
        if($request->ajax())
        {
            // $SchoolYear = SchoolYear::where('current', 1)
            //     ->where('status', 1)
            //     ->first();  

            if($request->date_from != '' && $request->date_to != '' && $request->school_year != 0)
            {      
                $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                    ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                    ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                    ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                    ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
                    ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')   
                    ->leftJoin('transaction_discounts', 'transaction_discounts.transaction_month_paid_id', 'transaction_month_paids.id')
                    ->selectRaw('
                        CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                        CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                        tuition_fees.tuition_amt,
                        misc_fees.misc_amt,
                        transaction_month_paids.payment,
                        transaction_month_paids.balance,
                        transaction_month_paids.approval,
                        transaction_month_paids.isSuccess,
                        transaction_month_paids.id as transact_monthly_id,
                        student_informations.id AS student_id,
                        transaction_month_paids.transaction_id,
                        transaction_month_paids.created_at,
                        transaction_discounts.discount_amt
                    ')
                    // ->whereBetween('transaction_month_paids.created_at', array($request->date_from, ))
                    ->whereDate('transaction_month_paids.created_at','>=',$request->date_from)
                    ->whereDate('transaction_month_paids.created_at','<=',$request->date_to)
                    ->where('transaction_month_paids.school_year_id', $request->school_year)
                    ->where('student_informations.status', 1)
                    ->where('transaction_month_paids.isSuccess', 1)
                    ->where('transaction_month_paids.approval', 'Approved')
                    ->orderBy('transaction_month_paids.id', 'ASC')
                    ->get();
            }
            else
            {
                $data = 'Incorrect data!';                
            }
            echo json_encode($data);
           
        }
    }

    public function print(Request $request) 
    {
        $now = Carbon::now()->toDateString();
        
        $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
            ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')   
            ->leftJoin('transaction_discounts', 'transaction_discounts.transaction_month_paid_id', 'transaction_month_paids.id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                tuition_fees.tuition_amt,
                misc_fees.misc_amt,
                transaction_month_paids.payment,
                transaction_month_paids.balance,
                transaction_month_paids.approval,
                transaction_month_paids.isSuccess,
                transaction_month_paids.id as transact_monthly_id,
                student_informations.id AS student_id,
                transaction_month_paids.transaction_id,
                transaction_month_paids.created_at,
                transaction_discounts.discount_amt
            ')
            ->whereDate('transaction_month_paids.created_at','>=',$request->date_from)
            ->whereDate('transaction_month_paids.created_at','<=',$request->date_to)
            ->where('transaction_month_paids.school_year_id', $request->school_year)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->orderBy('transaction_month_paids.id', 'ASC')
            ->get();

        
        $dataSum = $request->total;

        $PreparedBy = FinanceInformation::where('user_id', Auth::user()->id)->first();
        $fullname = $PreparedBy->first_name.' '.$PreparedBy->last_name;

        $SchoolYear = SchoolYear::where('id', $request->school_year)->first();              
        
        return view('control_panel_finance.payment_summary.partials.print', compact('data','SchoolYear','dataSum','fullname'))->render();
        $pdf = \PDF::loadView('control_panel_finance.payment_summary.partials.print', compact('data','SchoolYear','dataSum'));
        $pdf->setPaper('Legal', 'landscape');
        return $pdf->stream();          
    }
}