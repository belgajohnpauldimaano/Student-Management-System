<?php

namespace App\Http\Controllers\Finance;

use App\Models\SchoolYear;
use App\Models\Transaction;
use App\Models\StudentInformation;
use App\Models\TransactionDiscount;
use App\Models\TransactionOtherFee;
use Illuminate\Http\Request;
use App\Models\TransactionMonthPaid;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class StudentFinanceAccountController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request){

        $tab = $request->tab ? $request->tab : 'not-paid';

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $School_years = SchoolYear::where('status', 1)->orderBy('id', 'Desc')->get();

        $query = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')  
            ->join('transaction_month_paids', 'transaction_month_paids.transaction_id', '=' ,'transactions.id')                            
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
            ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')  
            ->selectRaw('
                CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                payment_categories.other_fee_id,
                student_informations.id as student_information_id,
                transactions.student_id,
                transactions.id,
                tuition_fees.tuition_amt,
                misc_fees.misc_amt, transactions.school_year_id, transactions.status
            ')
            ->where(function ($query) use ($request) {
                $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
            })
            ->where('student_informations.status', 1)
            ->orderBy('student_name', 'ASC')
            ->where('transaction_month_paids.isSuccess', 1);

        if($tab == 'paid')
        {
            $query->where('transactions.status', 0);
        }

        if($tab == 'not-paid')
        {
            $query->where('transactions.status', 1);
        }

        $student_account = $query->distinct()->paginate(10, ['transactions.id']);

        if ($request->ajax())
        {           
            return view('control_panel_finance.student_finance_account.partials.data_list',
                 compact('student_account', 'tab', 'School_years'));
        } 

        
        return view('control_panel_finance.student_finance_account.index', compact('student_account', 'tab', 'School_years'));
    }

    public function modal_data (Request $request) 
    {
        $Modal_data = NULL;
        $Mo_history = NULL;
                        
        if ($request->id)
        {
            $Modal_data = Transaction::where('id', $request->id)->first();
            
            $Discount = TransactionDiscount::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->sum('discount_amt');

            $Discount_amt = TransactionDiscount::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->get();

            
            $other_fee = Transaction::join('transaction_other_fees', 'transaction_other_fees.transaction_id','=', 'transactions.id')
                ->selectRaw('
                    transactions.student_id,
                    transactions.id as transactions_id,
                    transaction_other_fees.item_price, 
                    transaction_other_fees.other_name
                ')
                ->where('transactions.id', $request->id)
                ->where('transaction_other_fees.isSuccess', 1)
                ->first();
                
            // $other_fee = TransactionOtherFee::where('student_id', $Modal_data->student_id)
            //     ->where('school_year_id', $Modal_data->school_year_id)
            //     ->where('transaction_id', $Modal_data->id)
            //     ->where('isSuccess', 1)
            //     ->first();
            $other = 0;
            if($other_fee){
                $other = $other_fee->item_price;
            }

            $Mo_history = TransactionMonthPaid::where('transaction_id', $request->id)->where('isSuccess', 1)->get();

            $total = ($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $other) - $Discount;
        }
        return view('control_panel_finance.student_finance_account.partials.modal_data',
             compact('Modal_data','Mo_history','other_fee','Discount','Discount_amt','total','other'))->render();
    }

    public function paid(Request $request)
    {

        $Student_id = Transaction::where('id', $request->id)->first();
        $StudentInformation = StudentInformation::where('status', 1)
             ->where('id', $Student_id->student_id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;
                
        $Paid = Transaction::where('id', $request->id)->first();

        if ($Paid)
        {
            $Paid->status = 0;
            $Paid->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' payment status successfully paid.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function unpaid(Request $request)
    {
        $Student_id = Transaction::where('id', $request->id)->first();
        $StudentInformation = StudentInformation::where('status', 1)
            ->where('id', $Student_id->student_id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;
        $Unpaid = Transaction::where('id', $request->id)->first();       
        
        if ($Unpaid)
        {
            $Unpaid->status = 1;
            $Unpaid->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' payment status successfully unpaid.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}