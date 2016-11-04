<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 4.11.2016
 * Time: 15:40
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Tests\Controllers;

use Tests\MailTracking;
use JobBoard\Http\Controllers\NotificationInterface;

class EmailNotificationTest extends \TestCase
{
    use MailTracking;

    public function testSendNotification()
    {
        $notification = app(NotificationInterface::class);
        $notification->sendNotification("NewSubmission", "moderator@job-board.com", [
            "email" => "test@gmail.com",
            "poster_id" => 2,
            "title" => "Test Title",
            "description" => "Test Description"
        ]);
        $this->seeEmailWasSent()
            ->seeEmailSubject('New Submission')
            ->seeEmailTo('moderator@job-board.com')
            ->seeEmailContains('A new user posted a job. Please review and approve or mark it as a spam accordingly.')
            ->seeEmailContains("Test Title")
            ->seeEmailContains("Test Description");
    }
}
