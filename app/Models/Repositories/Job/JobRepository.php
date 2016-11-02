<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:31
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Job;

use Illuminate\Database\Eloquent\Model;
use \stdClass;

class JobRepository implements JobInterface
{
    protected $jobModel;

    /**
     * Setting our class $jobModel to the injected model
     *
     * @param Model $job
     */
    public function __construct(Model $job)
    {
        $this->jobModel = $job;
    }

    /**
     * Returns the job object associated with the passed id
     *
     * @param mixed $jobId
     * @return stdClass
     */
    public function getById($jobId)
    {
        return $this->convertFormat($this->jobModel->find($jobId));
    }

    public function getAll($orderBy, $direction, $limit = 10)
    {
        $data = array();
        foreach ($this->jobModel->whereHas('poster', function ($q) {
            $q->where('approved', 1)->where('spam', 0);
        })->orderBy($orderBy, $direction)->get() as $job) {
            $data[$job->id] = $job;
        }
        return $data;
    }

    public function save(array $request)
    {
        $this->jobModel->create($request);
    }


    /**
     * Converting the Eloquent object to a standard format
     *
     * @param mixed $job
     * @return stdClass
     */
    protected function convertFormat($job)
    {
        return $job ? (object)$job->toArray() : null;
    }
}