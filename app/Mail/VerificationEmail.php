<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code = '';
    public $Id = '';
    public $name = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$Id,$name)
    {
        $this->code = $code;
        $this->Id = $Id;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/verif');
    }
}
