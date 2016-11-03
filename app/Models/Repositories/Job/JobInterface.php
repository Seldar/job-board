<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:29
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Job;

/**
 * Interface JobInterface
 *
 * Interface for job repositories
 *
 * @package JobBoard\Models\Repositories\Job
 */
interface JobInterface
{
    /**
     * Returns all results according to specified $orderBy and $direction order and $limit
     *
     * @param string $orderBy Order by column name.
     * @param string $direction Order by direction.
     * @param int $limit limit the results.
     *
     * @return mixed
     */
    public function getAll($orderBy, $direction, $limit);

    /**
     * Returns the job object associated with the passed id
     *
     * @param int $jobId database id of the job to get
     *
     * @return mixed
     */
    public function getById($jobId);

    /**
     * Save the job data to database using $request data
     *
     * @param array $request
     *
     * @return mixed
     */
    public function save(array $request);
}