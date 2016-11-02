<?php

namespace JobBoard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class NewSubmission extends Mailable
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
        $this->params['approveUrl'] = URL::to('/posters/approve/' . $this->params['poster_id'] . "/" . urlencode(Hash::make($this->params['email'])));
        $this->params['spamUrl'] = URL::to('/posters/spam/' . $this->params['poster_id'] . "/" . urlencode(Hash::make($this->params['email'])));
        return $this->view("emails.new_submission");
    }
}
