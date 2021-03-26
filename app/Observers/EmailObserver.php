<?php

namespace App\Observers;

use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact\InformationEmail;

class EmailObserver
{
    /**
     * Handle the email "created" event.
     *
     * @param  \App\=Models\Email  $email
     * @return void
     */
    public function created(Email $email)
    {
        Mail::to('inquiry@sja-bataan.com')->send(new InformationEmail($email));
    }

    /**
     * Handle the email "updated" event.
     *
     * @param  \App\=Models\Email  $email
     * @return void
     */
    public function updated(Email $email)
    {
        //
    }

    /**
     * Handle the email "deleted" event.
     *
     * @param  \App\=Models\Email  $email
     * @return void
     */
    public function deleted(Email $email)
    {
        //
    }

    /**
     * Handle the email "restored" event.
     *
     * @param  \App\=Models\Email  $email
     * @return void
     */
    public function restored(Email $email)
    {
        //
    }

    /**
     * Handle the email "force deleted" event.
     *
     * @param  \App\=Models\Email  $email
     * @return void
     */
    public function forceDeleted(Email $email)
    {
        //
    }
}