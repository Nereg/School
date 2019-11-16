<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code = "";
    public $name = "";
    public $Id = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$name,$Id)
    {
        $this->code = $code;
        $this->name = $name;
        $this->Id = $Id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.pass');
    }
}
