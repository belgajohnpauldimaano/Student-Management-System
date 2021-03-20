<?php

namespace App\Mail\Finance;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnlineAppointmentFinanceMail extends Mailable
{
   
    use Queueable, SerializesModels;
    public $hasAppointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hasAppointment)
    {
        $this->hasAppointment = $hasAppointment; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.finance.online_appointment_finance_mail')
            ->subject('New Online Appointment');
    }
}