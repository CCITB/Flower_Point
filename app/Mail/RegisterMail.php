<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//어지수
class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public function __construct($random)
    {
        $this->order = $random;
    }

    /**
     * Build the message.
     *
     * @return $t his
     **/
    public function build()
    {
        //실제 메일에서 보여질 제목과 내용(blade파일에 있습니다.)
        //발송자는 from이아닌 Global "From" Address 이용
        return $this->subject('[꽃갈피] 인증메일입니다.')->view('emails.mail');

    }
}
