<?php

namespace JobBoard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JobBoard\Models\Repositories\Job\JobInterface;
use JobBoard\Models\Entities\Job;

/**
 * Class JobController
 *
 * Controller that handles Job related logic
 *
 * @package JobBoard\Http\Controllers
 */
class JobController extends Controller
{

    /**
     * Contains JobRepository to make database calls.
     *
     * @var JobInterface
     */
    protected $jobRepo;

    /**
     * Contains notification handler to send notifications to moderator.
     *
     * @var NotificationInterface
     */
    private $notification;

    /**
     * Loads $jobRepo and $notification with the actual concrete class associated with JobInterface and
     * NotificationInterface.
     *
     * @param JobInterface $jobRepo Repository to make database calls
     * @param NotificationInterface $notification Notification handler to send notifications
     */
    public function __construct(JobInterface $jobRepo, NotificationInterface $notification)
    {
        $this->jobRepo = $jobRepo;
        $this->notification = $notification;
    }

    /**
     * Shows the form for creating a new job post.
     *
     * @return Response
     */
    public function create()
    {
        return view("jobs.create_job");
    }

    /**
     * Stores a newly created job in database.
     *
     * @param Request $request Request object containing get/post parameters
     * @return Response
     */
    public function store(Request $request)
    {
        $poster = app(PosterController::class);
        $poster_id = $poster->save($request->email);
        if ($poster_id) {
            $job = ['title' => $request->title, 'description' => $request->description, 'poster_id' => $poster_id];
            if ($poster->newPoster) {
                $job['email'] = $request->email;
                $this->notification->sendNotification("NewSubmission", "moderator@job-board.com", $job);
            }
            $this->jobRepo->save($job);
            return view("jobs.job_submitted", array("title" => $request->title));
        }
        return redirect('jobs/create')
            ->withErrors($poster->errors)
            ->withInput();
    }

    /**
     * Returns all job data to view
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->jobRepo->getAll("title", "asc", 10);
        return view("jobs.job_list", array("data" => $data));
    }

    /**
     * @param Job $job Job entitiy to show details for
     * @return Response
     */
    public function show(Job $job)
    {
        return view("jobs.job_show", array("job" => $job));
    }
}
