<?php

namespace App\Mail\Admission;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\IncomingStudent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyNewRegisterStudentAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.admission.newly_registered')->subject('Account Activation');
    }
}