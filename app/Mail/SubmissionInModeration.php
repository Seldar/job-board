<?php

namespace JobBoard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SubmissionInModeration
 *
 * Controller to handle submission in moderation mails.
 *
 * @package JobBoard\Mail
 */
class SubmissionInModeration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Additional parameters to build the url's and dynamic content in the email body.
     *
     * @var array
     */
    public $params;

    /**
     * Create a new message instance with additional parameters.
     *
     * @param array $params Additional parameters
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Builds the email message.
     *
     * @return Mailable
     */
    public function build()
    {
        return $this->view("emails.submission_in_moderation");
    }
}
