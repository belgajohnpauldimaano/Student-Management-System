<?php

namespace App\Http\Controllers\Finance;

use App\SchoolYear;
use App\FinanceInformation;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubsidyDiscountController extends Controller
{
    use hasNotYetApproved;

    public function index(Request $request){
        $NotyetApprovedCount = $this->notYetApproved();
        $School_years = SchoolYear::where('status', 1)->orderBy('id', 'Desc')->get();

        return view('control_panel_finance.subsidy_discount_summary.index', compact('NotyetApprovedCount','School_years'));
    }

    function fetch_record(Request $request)
    {
        if($request->ajax())
        {
            // $SchoolYear = SchoolYear::where('current', 1)
            //     ->where('status', 1)
            //     ->first();  

            if($request->date_from != '' && $request->date_to != '' && $request->school_year != 0 && $request->category_type != 2)
            {    
                $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                    ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                    ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                    ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                    ->join('transaction_discounts', 'transaction_discounts.transaction_month_paid_id', '=' ,'transaction_month_paids.id')   
                    ->selectRaw('
                        CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                        CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                        transaction_discounts.created_at,
                        transaction_discounts.discount_amt,
                        transaction_discounts.category,
                        transaction_discounts.isSuccess,
                        transaction_discounts.id,
                        transaction_discounts.school_year_id,
                        student_informations.status
                    ')
                    ->whereDate('transaction_discounts.created_at','>=',$request->date_from)
                    ->whereDate('transaction_discounts.created_at','<=',$request->date_to)
                    ->where('transaction_discounts.school_year_id', $request->school_year)
                    ->where('transaction_discounts.category', $request->category_type)
                    ->where('student_informations.status', 1)
                    ->where('transaction_month_paids.status', 1)
                    ->where('transaction_discounts.isSuccess', 1)
                    ->where('transaction_month_paids.isSuccess', 1)
                    ->where('transaction_month_paids.approval', 'Approved')
                    ->orderBy('transaction_discounts.id', 'ASC')
                    ->distinct()
                    ->get(['transaction_discounts.id']);
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
        
        $category = $request->category_type;

        $data = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                    ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                    ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                    ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                    ->join('transaction_discounts', 'transaction_discounts.transaction_month_paid_id', '=' ,'transaction_month_paids.id')  
                    ->selectRaw('
                        CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                        CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                        transaction_discounts.created_at,
                        transaction_discounts.discount_amt,
                        transaction_discounts.category,
                        transaction_discounts.isSuccess,
                        transaction_discounts.id,
                        transaction_discounts.school_year_id,
                        student_informations.status
                    ')
                    ->whereDate('transaction_discounts.created_at','>=',$request->date_from)
                    ->whereDate('transaction_discounts.created_at','<=',$request->date_to)
                    ->where('transaction_discounts.school_year_id', $request->school_year)
                    ->where('transaction_discounts.category', $category)
                    ->where('student_informations.status', 1)
                    ->where('transaction_discounts.isSuccess', 1)
                    ->orderBy('transaction_discounts.id', 'ASC')
                    ->distinct()
                    ->get(['transaction_discounts.id']);

        
        $dataSum = $request->total;

        $PreparedBy = FinanceInformation::where('user_id', Auth::user()->id)->first();
        $fullname = $PreparedBy->first_name.' '.$PreparedBy->last_name;

        $SchoolYear = SchoolYear::where('id', $request->school_year)->first();              
        
        return view('control_panel_finance.subsidy_discount_summary.partials.print', compact('data','SchoolYear','dataSum','fullname','category'))->render();
        $pdf = \PDF::loadView('control_panel_finance.ubsidy_discount_summary.partials.print', compact('data','SchoolYear','dataSum','category','fullname'));
        $pdf->setPaper('Legal', 'landscape');
        return $pdf->stream();          
    }
}
