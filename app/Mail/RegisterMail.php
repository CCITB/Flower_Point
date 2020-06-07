<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     **/
    public function build()
    {
        //발송자는 from이아닌 Global "From" Address 이용
        return $this->view('emails.mail');

        // return $this->view('view.name');
        // return $this->subject('꽃갈피 인증메일')
        //             ->view('emails.mail');
    }
}