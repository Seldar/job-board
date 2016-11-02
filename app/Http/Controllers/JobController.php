<?php

namespace JobBoard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JobBoard\Models\Repositories\Job\JobInterface;
use JobBoard\Models\Entities\Job;

class JobController extends Controller
{

    /**
     * Containing our jobRepository to make all our database calls to
     *
     * @var JobInterface
     */
    protected $jobRepo;

    private $notification;

    /**
     * Loads our $jobRepo with the actual Repo associated with our jobInterface
     *
     * @param jobInterface $jobRepo
     * @param NotificationInterface $notification
     */
    public function __construct(JobInterface $jobRepo, NotificationInterface $notification)
    {
        $this->jobRepo = $jobRepo;
        $this->notification = $notification;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("jobs.create_job");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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

    public function index()
    {
        $data = $this->jobRepo->getAll("title", "asc",10);
        return view("jobs.job_list", array("data" => $data));
    }

    public function show(Job $job)
    {
        return view("jobs.job_show", array("job" => $job));
    }
}
