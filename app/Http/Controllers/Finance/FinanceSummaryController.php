<?php

namespace App\Http\Controllers\Finance;

use Carbon\Carbon;
use App\SchoolYear;
use Barryvdh\DomPDF\PDF;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\TransactionMonthPaid;
use App\Http\Controllers\Controller;

class FinanceSummaryController extends Controller
{
    public function index(Request $request)
    {
       return view('control_panel_finance.payment_summary.index');
    }
    
    function fetch_record(Request $request)
    {
        if($request->ajax())
        {
            $SchoolYear = SchoolYear::where('current', 1)
                ->where('status', 1)
                ->first();  

            if($request->date_from != '' && $request->date_to != '')
            {                
               

                $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                    ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                    ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                    ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                    ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
                    ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')   
                    ->leftJoin('transaction_discounts', 'transaction_discounts.transaction_id', 'transactions.id')
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
                    ->whereBetween('transaction_month_paids.created_at', array($request->date_from, $request->date_to))
                    ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                    ->where('student_informations.status', 1)
                    ->where('transaction_month_paids.isSuccess', 1)
                    ->where('transaction_month_paids.approval', 'Approved')
                    ->orderBy('transaction_month_paids.id', 'ASC')
                    ->get();
            }
            else
            {
                $data = TransactionMonthPaid::where('approval', 'Approved')
                    ->where('isSuccess', 1)
                    ->get();
            }
            echo json_encode($data);
        }
    }

    public function print(Request $request) 
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();  

        $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
            ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')   
            ->leftJoin('transaction_discounts', 'transaction_discounts.transaction_id', 'transactions.id')
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
            ->whereBetween('transaction_month_paids.created_at', array($request->date_from, $request->date_to))
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->orderBy('transaction_month_paids.id', 'ASC')
            ->get();

        
        $dataSum = TransactionMonthPaid::where('approval', 'Approved')
            ->whereBetween('created_at', array($request->date_from, $request->date_to))
            ->where('isSuccess', 1)->sum('payment');
            
        
        return view('control_panel_finance.payment_summary.partials.print', compact('data','SchoolYear','dataSum'))->render();
        $pdf = \PDF::loadView('control_panel_finance.payment_summary.partials.print', compact('data','SchoolYear','dataSum'));
        $pdf->setPaper('Legal', 'landscape');
        return $pdf->stream();          
    }
}
