<?php

namespace JobBoard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionInModeration extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("emails.submission_in_moderation");
    }
}
