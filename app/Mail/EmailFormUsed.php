<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailFormUsed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $theEmailFrom;

    /**
     * @var string
     */
    public $theEmailSubject;

    /**
     * @var string
     */
    public $theEmailMessage;

    /**
     * EmailFormUsed constructor.
     *
     * @param string $theEmailFrom
     * @param string $theEmailSubject
     * @param string $theEmailMessage
     */
    public function __construct($theEmailFrom, $theEmailSubject, $theEmailMessage)
    {
        $this->theEmailFrom = $theEmailFrom;
        $this->theEmailSubject = $theEmailSubject;
        $this->theEmailMessage = $theEmailMessage;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Email form used: ' . $this->theEmailSubject)
            ->view('emails.email_form_used');
    }
}
