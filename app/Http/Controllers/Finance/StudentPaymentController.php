<?php

namespace App\Http\Controllers\Finance;

use App\Models\SchoolYear;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\HasSchoolYear;
use App\Models\PaymentCategory;
use App\Traits\hasNotYetApproved;
use App\Models\StudentInformation;
use App\Models\TransactionDiscount;
use App\Models\TransactionOtherFee;
use App\Http\Controllers\Controller;
use App\Models\TransactionMonthPaid;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\NotifyDisapprovePaymentMail;
use App\Exports\StudentPaymentApprovedExport;
use App\Mail\NotifyStudentApprovedFinanceMail;


class StudentPaymentController extends Controller
{
    use HasSchoolYear,  hasNotYetApproved;

    private function studentPayment($request)
    {
        $SchoolYear = $this->schoolYearActiveStatus();

        return StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->join('tuition_fees', 'tuition_fees.id', '=', 'payment_categories.tuition_fee_id')
                ->join('misc_fees', 'misc_fees.id', '=', 'payment_categories.misc_fee_id')   
                ->selectRaw('
                    CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
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
                    transactions.school_year_id
                ')
                ->where(function ($query) use ($request) {
                    $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
                })
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->orderBy('transaction_month_paids.id', 'DESC')
                ->distinct();
    }

    public function index(Request $request)
    {
        $notYetApprovedCount = $this->notYetApproved();
        $NotyetApproved = $this->studentPayment($request)
            ->where('transaction_month_paids.approval', 'Not yet approved')->paginate(10, ['transaction_id']);
        if ($request->ajax())
        {
           return view('control_panel_finance.student_payment.not_yet_approved.partials.data_list', 
            compact('NotyetApproved','SchoolYear','notYetApprovedCount'));
        }
        return view('control_panel_finance.student_payment.not_yet_approved.index', 
            compact('NotyetApproved','SchoolYear','notYetApprovedCount'));
    }

    public function approved(Request $request)
    {
        $Approved = $this->studentPayment($request)
            ->where('transaction_month_paids.approval', 'Approved')->paginate(10, ['transaction_id']);
        
        if ($request->ajax())
        {
            return view('control_panel_finance.student_payment.approved.partials.data_list', 
                compact('Approved', 'NotyetApprovedCount','SchoolYear'));
        } 

        return view('control_panel_finance.student_payment.approved.index', 
            compact('Approved','SchoolYear','NotyetApprovedCount'));
    }

    public function disapproved(Request $request)
    {
        $Disapproved = $this->studentPayment($request)
            ->where('transaction_month_paids.approval', 'Disapproved')->paginate(10, ['transaction_id']);

        if ($request->ajax())
        {
            return view('control_panel_finance.student_payment.disapproved.partials.data_list', compact('Disapproved', 'NotyetApprovedCount'));
        } 
        
        return view('control_panel_finance.student_payment.disapproved.index', 
            compact('Disapproved','SchoolYear','NotyetApprovedCount'));
    }
    
    public function modal_data (Request $request) 
    {
        $Modal_data = NULL;
        $Monthly_history = NULL;

        if ($request->id && $request->monthly_id)
        {
            $Modal_data = Transaction::where('id', $request->id)->first();
            $Monthly_history = TransactionMonthPaid::where('id', $request->monthly_id)->first();
            $current_bal = TransactionMonthPaid::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->where('approval', 'Approved')
                ->orderBY('id', 'desc')
                ->skip(1)->take(1)->first();
        }
        return view('control_panel_finance.student_payment.not_yet_approved.partials.modal_data', compact('Modal_data','Monthly_history','current_bal'))->render();
    }

    public function modal_data_approved (Request $request) 
    {
        $Modal_data = NULL;
        $Monthly_history = NULL;

        if ($request->id && $request->monthly_id)
        {
            $Modal_data = Transaction::where('id', $request->id)->first();
            $Monthly_history = TransactionMonthPaid::where('id', $request->monthly_id)->first();
            $current_bal = TransactionMonthPaid::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->where('approval', 'Approved')
                ->orderBY('id', 'desc')
                ->skip(1)->take(1)->first();
        }
        return view('control_panel_finance.student_payment.approved.partials.modal_data', compact('Modal_data','Monthly_history','current_bal'))->render();
    }

    public function approve(Request $request)
    {
        $Student_id = TransactionMonthPaid::where('id', $request->id)->first();
        $StudentInformation = StudentInformation::where('status', 1)
             ->where('id', $Student_id->student_id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;
                
        $Approve = TransactionMonthPaid::where('id', $request->id)->first();
        if($request->incoming_bal != '')
        {
            if ($Approve)
            {
                $Approve->balance = $request->incoming_bal;
                $Approve->approval = 'Approved';
                $Approve->save();

                // $Approve = TransactionMonthPaid::where('id', $request->id)->first();
                $payment = TransactionMonthPaid::find($request->id);
                        \Mail::to($Approve->email)->send(new NotifyStudentApprovedFinanceMail($payment));

                return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' payment status successfully approved.']);
            }
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.'.$request->incoming_bal]);
    }

    public function disapprove(Request $request)
    {
        $Student_id = TransactionMonthPaid::where('id', $request->id)->first();
        $StudentInformation = StudentInformation::where('status', 1)
            ->where('id', $Student_id->student_id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;
        $NotyetApproved = TransactionMonthPaid::where('id', $request->id)->first();  
        
        if ($NotyetApproved)
        {
            $check_discount = TransactionDiscount::where('transaction_month_paid_id', $NotyetApproved->id)->first();

            if(!$check_discount){
                $discount = TransactionDiscount::where('transaction_month_paid_id', $NotyetApproved->id)->get();

                foreach($discount as $data){
                    $discount = TransactionDiscount::where('transaction_month_paid_id', $data->id)->first();
                    $discount->isSuccess = 0;
                    $discount->save();
                }
            }
            
            $NotyetApproved->approval = 'Disapproved';
            $NotyetApproved->save();

            $payment = TransactionMonthPaid::find($request->id);
                    \Mail::to($NotyetApproved->email)->send(new NotifyDisapprovePaymentMail($payment));
                    
            return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' payment status successfully disapproved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
    
    public function badge(Request $request)
    {
        $NotyetApprovedCount = TransactionMonthPaid::where('approval', 'Not yet Approved')->where('isSuccess', 1)
            ->count();
    }

    public function excel(Request $request)
    {
        return Excel::download(new StudentPaymentApprovedExport(), 'Student Payment.xlsx');
    }

    
}