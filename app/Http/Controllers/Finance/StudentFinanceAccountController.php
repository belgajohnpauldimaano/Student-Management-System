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

            $StudentAccount = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
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
            ->orderBy('student_name', 'ASC')
            ->paginate(10); 

            return view('control_panel_finance.student_finance_account.partials.data_list', compact('StudentAccount'));
        } 

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();  

        $StudentAccount = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')                           
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
            ->orderBy('student_name', 'ASC')
            ->paginate(10);
        
        return view('control_panel_finance.student_finance_account.index', compact('StudentAccount'));
    }

    public function modal_data (Request $request) 
    {
        $Modal_data = NULL;
        $Mo_history = NULL;
        if ($request->id)
        {
            $Modal_data = Transaction::where('id', $request->id)->first();
            $Mo_history = TransactionMonthPaid::where('transaction_id', $request->id)->get();
        }
        return view('control_panel_finance.student_finance_account.partials.modal_data', compact('Modal_data','Mo_history'))->render();
    }
}
