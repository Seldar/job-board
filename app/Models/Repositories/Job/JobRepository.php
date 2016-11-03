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

/**
 * Class JobRepository
 *
 * Job repository to handle data layer logic for Job entity.
 *
 * @package JobBoard\Models\Repositories\Job
 */
class JobRepository implements JobInterface
{
    /**
     * Job entity to make database calls.
     *
     * @var Model
     */
    private $jobModel;

    /**
     * Sets the $job Model to the injected model.
     *
     * @param Model $job Job Model to inject
     */
    public function __construct(Model $job)
    {
        $this->jobModel = $job;
    }

    /**
     * Returns the job object associated with the passed id
     *
     * @param int $jobId Database id of the associated job
     * @return stdClass
     */
    public function getById($jobId)
    {
        return $this->convertFormat($this->jobModel->find($jobId));
    }

    /**
     * Returns all results according to specified $orderBy and $direction order and $limit
     *
     * @param string $orderBy Order by column name.
     * @param string $direction Order by direction.
     * @param int $limit limit the results.
     * @return array
     */
    public function getAll($orderBy, $direction, $limit = 100)
    {
        $data = array();
        foreach ($this->jobModel->whereHas('poster', function ($q) {
            $q->where('approved', 1)->where('spam', 0);
        })->orderBy($orderBy, $direction)->take($limit)->get() as $job) {
            $data[$job->id] = $job;
        }
        return $data;
    }

    /**
     * Save the job data to database using $request data.
     *
     * @param array $request
     * @return void
     */
    public function save(array $request)
    {
        $this->jobModel->create($request);
    }


    /**
     * Converts the Eloquent object to a standard format
     *
     * @param Model $job
     * @return stdClass
     */
    protected function convertFormat($job)
    {
        return $job ? (object)$job->toArray() : null;
    }
}