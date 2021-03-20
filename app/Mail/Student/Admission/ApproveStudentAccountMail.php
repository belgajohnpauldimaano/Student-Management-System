<?php

namespace App\Mail\Student\Admission;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveStudentAccountMail extends Mailable
{
    use Queueable, SerializesModels;
    public $student;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $pdf = PDF::loadView('control_panel_admission.incoming.partials.print', compact('student'));
        return $this->view('mails.student.admission.student_account_activation')
            ->subject('Account Activation');
    }
}