<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:31
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Poster;

use Illuminate\Database\Eloquent\Model;
use \stdClass;

class PosterRepository implements PosterInterface
{
    protected $posterModel;

    /**
     * Setting our class $jobModel to the injected model
     *
     * @param Model $poster
     */
    public function __construct(Model $poster)
    {
        $this->posterModel = $poster;
    }

    /**
     * Returns the job object associated with the passed id
     *
     * @param mixed $email
     * @return stdClass
     */
    public function getByEmail($email)
    {
        return $this->convertFormat($this->posterModel->where("email",$email)->first());
    }

    public function getAll(array $order, $limit = 10)
    {

    }

    public function save($email)
    {
        $this->posterModel->email = $email;
        $this->posterModel->save();
        return $this->posterModel->id;
    }


    /**
     * Converting the Eloquent object to a standard format
     *
     * @param mixed $job
     * @return stdClass
     */
    protected function convertFormat($job)
    {
        return $job ? (object) $job->toArray() : null;
    }
}