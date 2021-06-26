<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $verification_code)
    {
        $this->user = $user;
        $this->verification_code = $verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lconline@lconline.ge')
            ->subject('Account verification')
            ->view('mail.signup-email', ['user' => $this->user, 'verification_code' => $this->verification_code ]);
    }
}
