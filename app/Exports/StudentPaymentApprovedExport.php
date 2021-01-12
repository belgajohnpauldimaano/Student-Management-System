<?php

namespace App\Exports;

use App\Models\SchoolYear;
use App\Models\StudentInformation;
use App\Models\TransactionDiscount;
use App\Models\TransactionOtherFee;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentPaymentApprovedExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return StudentInformation::all();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $Approved = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
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
                transactions.school_year_id,
                transaction_month_paids.number
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->orderBy('transaction_month_paids.id', 'DESC')
            ->get();

        $approved_array[] = array('Student Name', 'Student Level', 'Phone Number', 'Tuition Fee', 'Misc Fee', 'Other Fee', 'Disc Fee' ,'Total Fees', 'Payment', 'Balance');
        
        foreach($Approved as $data)
        {
            $approved_array[] = array(
                    'Student Name'      => $data->student_name,
                    'Student Level'     => $data->student_level,
                    'Phone Number'      => $data->number,
                    'Tuition Fee'       => number_format($data->tuition_amt,2),
                    'Misc Fee'          => number_format($data->misc_amt,2),
                    'Other Fee'         => number_format($other = TransactionOtherFee::where('student_id', $data->student_id)
                                                ->where('school_year_id', $data->school_year_id)
                                                ->where('transaction_id', $data->transaction_id)
                                                ->where('isSuccess', 1)
                                                ->sum('item_price'),2),
                    'Disc Fee'          =>  number_format($discount = TransactionDiscount::where('student_id', $data->student_id)
                                                ->where('school_year_id', $data->school_year_id)
                                                ->where('isSuccess', 1)
                                                ->sum('discount_amt'),2),

                    'Total Fee'         => number_format(($data->tuition_amt + $data->misc_amt + $other) - $discount, 2),
                    'Payment'           => number_format($data->payment,2),
                    'Balance'           => number_format($data->balance,2),
            );
        }

        return collect($approved_array);
    }

    // public function headings(): array
    // {
    //     return [
    //         'Student Name',
    //         'Student Level',
    //         'Phone Number',
    //         'Tuition Fee',
    //         'Misc Fee',
    //         'Other Fee',
    //         'Disc Fee',
    //         'Total Fee',
    //         'Payment',
    //         'Balance'      
    //     ];
    // }
}