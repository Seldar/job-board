<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:29
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Job;

use Illuminate\Http\Request;

interface JobInterface
{
    public function getAll($orderBy, $direction, $limit);

    public function getById($jobId);

    public function save(array $request);
}