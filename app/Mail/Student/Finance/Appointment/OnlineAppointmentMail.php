<?php

namespace App\Mail\Student\Finance\Appointment;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnlineAppointmentMail extends Mailable
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
        return $this->view('mails.student.finance.appointment.online_appointment_mail')
            ->subject('Online Appointment Confirmation');
    }
}