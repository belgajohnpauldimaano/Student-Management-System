<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Models\IncomingStudent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\Admission\NotifyNewRegisterStudentAdminMail;
use App\Mail\Student\Admission\NotifyNewRegisterStudentMail;

class RegistrationNotification extends Notification
{
    use Queueable;
    public $payload;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new NotifyNewRegisterStudentAdminMail($this->payload));
        return Mail::to($this->payload->studentEmail->email)->send(new NotifyNewRegisterStudentMail($this->payload));
        // ->view('mails.admission.newly_registered', ['payload' => $this->payload])->subject('Account Activation');
        //   return (new NotifyNewRegisterStudentAdminMail(['payload' => $this->payload]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'         =>  'Student Registration',  // title,
            'avatar'        =>  $this->payload->student->photo,
            'message'       =>  'Student '.$this->payload->student->last_name.', '.$this->payload->student->first_name.' '.$this->payload->student->middle_name.'is now registered!',  // message,
            'notif_type'    =>  'Admission',
            'item_id'       =>  $this->payload->id,
            'read_at'       =>  '',
            'timestamp'     =>  Carbon::now()->format("Y-m-d h:i:s") // timestamp
        ];
    }
}