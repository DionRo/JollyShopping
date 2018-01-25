<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_info, $path)
    {
        $this->order = $order_info;
        $this->attachment = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("recovery@jollyshopping.nl")
            ->attach($this->attachment)
            ->view('newsletter/newsletter');
    }
}
