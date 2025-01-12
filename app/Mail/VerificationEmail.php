<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;
    public $name;
    public $expirationTime;

    /**
     * Create a new message instance.
     */
    public function __construct($verificationCode, $name, $expirationTime)
    {
        $this->verificationCode = $verificationCode;
        $this->name = $name;
        $this->expirationTime = $expirationTime;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.verification')
                    ->with([
                        'verificationCode' => $this->verificationCode,
                        'name' => $this->name,
                        'expirationTime' => $this->expirationTime,
                    ]);
    }
}
