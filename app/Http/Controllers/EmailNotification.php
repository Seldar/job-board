<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 2.11.2016
 * Time: 12:46
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use JobBoard\Mail\SubmissionInModeration;
use JobBoard\Mail\NewSubmission;

class EmailNotification implements NotificationInterface
{
    public function sendNotification($mailable, $to, $params) {
        $className = "JobBoard\\Mail\\" . $mailable;
        Mail::to($to)->send(new $className($params));
    }
}