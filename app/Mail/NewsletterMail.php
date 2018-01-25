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
    public $newsletter;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_info, $path, $newsletter, $user)
    {
        $this->order = $order_info;
        $this->attachment = $path;
        $this->newsletter = $newsletter;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("mailkabouter@jollyshopping.nl")
            ->attach($this->attachment)
            ->view('newsletter/newsletter')
            ->with('newsletter', $this->newsletter)
            ->with('user', $this->user);
    }
}
