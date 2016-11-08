<?php

namespace JobBoard\Http\Controllers;

use Illuminate\Http\Response;
use JobBoard\Http\Controllers\NotificationInterface;
use JobBoard\Models\Repositories\Poster\PosterInterface;
use JobBoard\Models\Entities\Poster;
use Illuminate\Support\Facades\Hash;

/**
 * Class PosterController
 *
 * Controller that handles Poster related logic.
 *
 * @package JobBoard\Http\Controllers
 */
class PosterController extends Controller
{
    /**
     * Contains PosterRepository to make database calls.
     *
     * @var PosterInterface
     */
    private $posterRepo;

    /**
     * Contains notification handler to send notifications to poster.
     *
     * @var NotificationInterface
     */
    private $notification;

    /**
     * Contains errors to show in views.
     *
     * @var array
     */
    public $errors;

    /**
     * Contains if a new poster is created in the database.
     *
     * @var bool
     */
    public $newPoster = 0;

    /**
     * Loads $posterRepo and $notification with the actual concrete class associated with PosterInterface and
     * NotificationInterface.
     *
     * @param PosterInterface $posterRepo Repository to make database calls
     * @param NotificationInterface $notification Notification handler to send notifications
     */
    public function __construct(PosterInterface $posterRepo, NotificationInterface $notification)
    {
        $this->posterRepo = $posterRepo;
        $this->notification = $notification;
    }

    /**
     * Saves the poster associated with $email.
     *
     * Saves a new poster if a poster with $email does not exists and sends notification to the poster.
     * If the poster exists, checks its status and fill $this->error if any obstacles for posting a job exists.
     *
     * @param string $email Email address of the poster
     *
     * @return int|bool
     */
    public function save($email)
    {

        if (!$email) {
            $this->errors['email'] = "Please enter your email address!";
            return false;
        }

        $currPoster = $this->posterRepo->getByEmail($email);
        if (!$currPoster) {
            $this->notification->sendNotification("SubmissionInModeration", $email, []);
            $this->newPoster = 1;
            return $this->posterRepo->save($email);
        } else {
            if ($currPoster->spam) {
                $this->errors['email'] = "Your email is tagged as spam!";
                return false;
            } elseif (!$currPoster->approved) {
                $this->errors['email'] = "Your submission is still in moderation!";
                return false;
            } else {
                return $currPoster->id;
            }
        }

    }

    /**
     * Approves the poster if the hashed key is correct.
     *
     * @param Poster $poster Poster model to be approved
     * @param string $key Hashed key for security purposes
     *
     * @return Response
     */
    public function approve(Poster $poster, $key)
    {
        if ($this->checkEmailHash($poster->email, $key)) {
            $poster->approved = 1;
            $poster->save();
            return view("posters.approve_successful");
        }
        return view("posters.approve_fail");
    }

    /**
     * Marks the poster as spammer if hashed key is correct.
     *
     * @param Poster $poster Poster model to be marked as spam
     * @param string $key Hashed key for security purposes
     *
     * @return Response
     */
    public function spam(Poster $poster, $key)
    {
        if ($this->checkEmailHash($poster->email, $key)) {
            $poster->spam = 1;
            $poster->save();
            return view("posters.spam_successful");
        }
        return view("posters.spam_fail");
    }

    /**
     * Checks given email string with the hashed key received.
     *
     * @param string $email
     * @param string $key
     *
     * @return string
     */
    public function checkEmailHash($email, $key)
    {
        return Hash::check($email, str_replace("|", "/", $key));
    }

}
