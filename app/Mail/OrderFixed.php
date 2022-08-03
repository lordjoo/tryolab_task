<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFixed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var mixed|string
     */
    private mixed $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status = 'success')
    {
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.orderfixed',[
            "status" => $this->status,
        ]);
    }
}
