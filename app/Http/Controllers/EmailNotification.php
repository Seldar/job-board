<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 2.11.2016
 * Time: 12:46
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use JobBoard\Mail\SubmissionInModeration;
use JobBoard\Mail\NewSubmission;

/**
 * Class EmailNotification
 *
 * Handles sending of email notifications.
 *
 * @package JobBoard\Http\Controllers
 */
class EmailNotification implements NotificationInterface
{
    /**
     * Sends notification by email.
     *
     * @param string $mailable The mailable class name to initialize
     * @param string $to Email recipient
     * @param array $params Additional parameters to include the notification text
     *
     * @return void
     */
    public function sendNotification($mailable, $to, array $params)
    {
        $className = "JobBoard\\Mail\\" . $mailable;
        Mail::to($to)->send(new $className($params));
    }
}