<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationService extends Mailable
{
    use Queueable, SerializesModels;

    public $arrayData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($arrayData)
    {
        $this->arrayData = $arrayData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->arrayData['entity'].' - '. config('app.name'));
        $this->view('emails.notificationService');
        return $this;
    }
}
