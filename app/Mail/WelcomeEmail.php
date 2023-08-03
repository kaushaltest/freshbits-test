<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emailSubject,$emailContect,$userName;
    public function __construct($emailSubject,$emailContect,$userName)
    {
        $this->emailSubject=$emailSubject;
        $this->emailContect=$emailContect;
        $this->userName=$userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('freshbits@test.com')
        ->view('welcome')
        ->with([
            'username' => $this->userName,
            'content' =>$this->emailContect,
            // Add more data as needed
        ])
                    ->subject($this->emailSubject);
    }
}
