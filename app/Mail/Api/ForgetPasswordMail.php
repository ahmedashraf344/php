<?php

namespace App\Mail\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@zonefinal.com')->with(['name'=>$this->name,'code'=>$this->code])
            ->view('emails.forget_password_code');
    }
}
