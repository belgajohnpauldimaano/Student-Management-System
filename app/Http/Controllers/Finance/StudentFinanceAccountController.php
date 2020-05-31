<?php

namespace App\Http\Controllers\Finance;

use App\SchoolYear;
use App\Transaction;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\TransactionMonthPaid;
use App\Http\Controllers\Controller;

class StudentFinanceAccountController extends Controller
{
    public function index(Request $request){

        if ($request->ajax())
        {           
            $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

            $Unpaid = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                    transactions.student_id,
                    student_informations.id,
                    transactions.id as transactions_id
                ')
                ->where(function ($query) use ($request) {
                    $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
                })
                ->where('student_informations.status', 1)
                ->where('transactions.status', 1)
                ->orderBy('student_name', 'ASC')
                ->paginate(10); 

            $Paid = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                    transactions.student_id,
                    student_informations.id,
                    transactions.id as transactions_id
                ')
                ->where(function ($query) use ($request) {
                    $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
                })
                ->where('student_informations.status', 1)
                ->where('transactions.status', 0)
                ->orderBy('student_name', 'ASC')
                ->paginate(10); 


            return view('control_panel_finance.student_finance_account.partials.data_list', compact('Unpaid','Paid'));
        } 

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();  

        $Unpaid = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                transactions.student_id,
                student_informations.id,
                transactions.id as transactions_id
            ')
            ->where('transactions.status', 1)
            ->where('student_informations.status', 1)
            ->orderBy('student_name', 'ASC')
            ->paginate(10);
        
        $Paid = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,
                transactions.student_id,
                student_informations.id,
                transactions.id as transactions_id
            ')
            ->where('student_informations.status', 1)
            ->where('transactions.status', 0)
            ->orderBy('student_name', 'ASC')
            ->paginate(10); 
        
        return view('control_panel_finance.student_finance_account.index', compact('Unpaid','Paid'));
    }

    public function modal_data (Request $request) 
    {
        $Modal_data = NULL;
        $Mo_history = NULL;
        if ($request->id)
        {
            $Modal_data = Transaction::where('id', $request->id)->first();
            $Mo_history = TransactionMonthPaid::where('transaction_id', $request->id)->where('isSuccess', 1)->get();
        }
        return view('control_panel_finance.student_finance_account.partials.modal_data', compact('Modal_data','Mo_history'))->render();
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
