<?php

namespace App\Mail\Student\Finance\Payment;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStudentApprovedFinanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $payment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.student.finance.payment.approved_finance')
            ->subject('Online Payment Register Confirmation');
    }
}