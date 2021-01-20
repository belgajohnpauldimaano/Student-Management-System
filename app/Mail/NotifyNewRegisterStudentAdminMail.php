<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyNewRegisterStudentAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $NewStudent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($NewStudent)
    {
        $this->NewStudent = $NewStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newly_registered')->subject('Account Activation');
    }
}