<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user; // Pass user info to the email
    }

    public function build()
    {
        return $this->subject('Thanks fo Registraion')
            ->view('emails.registration');
    }
}
