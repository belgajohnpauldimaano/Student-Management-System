<?php

namespace App\Observers;

use App\Models\IncomingStudent;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyNewRegisterStudentMail;
use App\Mail\NotifyNewRegisterStudentAdminMail;

class IncomingStudentObserver
{
    /**
     * Handle the incoming student "created" event.
     *
     * @param  \App\Models\IncomingStudent  $incomingStudent
     * @return void
     */
    public function created(IncomingStudent $incomingStudent)
    {
        Mail::to($incomingStudent->studentEmail->email)->send(new NotifyNewRegisterStudentMail($incomingStudent));
        // Mail::to('admission@sja-bataan.com')->cc('inquiry@sja-bataan.com')->send(new NotifyNewRegisterStudentAdminMail($incomingStudent));
    }

    /**
     * Handle the incoming student "updated" event.
     *
     * @param  \App\Models\IncomingStudent  $incomingStudent
     * @return void
     */
    public function updated(IncomingStudent $incomingStudent)
    {
        //
    }

    /**
     * Handle the incoming student "deleted" event.
     *
     * @param  \App\Models\IncomingStudent  $incomingStudent
     * @return void
     */
    public function deleted(IncomingStudent $incomingStudent)
    {
        //
    }

    /**
     * Handle the incoming student "restored" event.
     *
     * @param  \App\Models\IncomingStudent  $incomingStudent
     * @return void
     */
    public function restored(IncomingStudent $incomingStudent)
    {
        //
    }

    /**
     * Handle the incoming student "force deleted" event.
     *
     * @param  \App\Models\IncomingStudent  $incomingStudent
     * @return void
     */
    public function forceDeleted(IncomingStudent $incomingStudent)
    {
        //
    }
}