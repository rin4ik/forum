<?php

namespace App\Listeners;

use \App\Mail\PleaseConfirmYourEmail;
use Illuminate\Auth\Events\Registered;
use \Illuminate\Support\Facades\Mail;

class SendEmailConfirmationRequest
{
    public function __construct()
    {
        //
    }

    public function handle(Registered $event)
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmail($event->user));
    }
}
