<?php

namespace JobBoard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

/**
 * Class NewSubmission
 *
 * Controller to handle new submission mails.
 *
 * @package JobBoard\Mail
 */
class NewSubmission extends Mailable
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
        $this->params['approveUrl'] = URL::to('/posters/approve/' . $this->params['poster_id'] . "/" . str_replace("/", "|", Hash::make($this->params['email'])));
        $this->params['spamUrl'] = URL::to('/posters/spam/' . $this->params['poster_id'] . "/" . str_replace("/", "|", Hash::make($this->params['email'])));
        return $this->view("emails.new_submission");
    }
}
