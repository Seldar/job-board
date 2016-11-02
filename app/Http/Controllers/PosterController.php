<?php

namespace JobBoard\Http\Controllers;

use Illuminate\Http\Response;
use JobBoard\Http\Controllers\NotificationInterface;
use JobBoard\Models\Repositories\Poster\PosterInterface;
use JobBoard\Models\Entities\Poster;
use Illuminate\Support\Facades\Hash;

class PosterController extends Controller
{
    /**
     * Containing our posterRepository to make all our database calls to
     *
     * @var PosterInterface
     */
    private $posterRepo;

    private $notification;

    public $errors;

    public $newPoster = 0;

    /**
     * Loads our $jobRepo with the actual Repo associated with our jobInterface
     *
     * @param PosterInterface $posterRepo
     * @param NotificationInterface $notification
     */
    public function __construct(PosterInterface $posterRepo, NotificationInterface $notification)
    {
        $this->posterRepo = $posterRepo;
        $this->notification = $notification;
    }

    public function save($email)
    {
        $currPoster = $this->posterRepo->getByEmail($email);
        if (!$currPoster) {
            $this->notification->sendNotification("SubmissionInModeration", $email, []);
            $this->newPoster = 1;
            return $this->posterRepo->save($email);
        } else {
            if ($currPoster->spam || !$currPoster->approved) {
                if ($currPoster->spam) {
                    $this->errors['email'] = "Your email is tagged as spam!";
                } elseif (!$currPoster->approved) {
                    $this->errors['email'] = "Your submission is still in moderation!";
                }
                return false;

            } else {
                return $currPoster->id;
            }
        }
    }

    public function approve(Poster $poster, $key)
    {
        if (Hash::check($poster->email, $key)) {
            $poster->approved = 1;
            $poster->save();
            return view("posters.approve_successful");
        }
        return view("posters.approve_fail");
    }

    public function spam(Poster $poster, $key)
    {
        if (Hash::check($poster->email, $key)) {
            $poster->spam = 1;
            $poster->save();
            return view("posters.spam_successful");
        }
        return view("posters.spam_fail");
    }

}
