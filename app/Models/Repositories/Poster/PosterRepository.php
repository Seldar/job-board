<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:31
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Poster;

use Illuminate\Database\Eloquent\Model;
use \stdClass;

/**
 * Class PosterRepository
 *
 * Poster repository to handle data layer logic for Poster entity.
 *
 * @package JobBoard\Models\Repositories\Poster
 */
class PosterRepository implements PosterInterface
{
    /**
     * Poster entity to make database calls.
     *
     * @var Model
     */
    private $posterModel;

    /**
     * Sets the $poster Model to the injected model.
     *
     * @param Model $poster Poster Model to inject
     */
    public function __construct(Model $poster)
    {
        $this->posterModel = $poster;
    }

    /**
     * Returns the poster object associated with the passed email address.
     *
     * @param string $email Email address of the poster to be retrieved.
     *
     * @return stdClass
     */
    public function getByEmail($email)
    {
        return $this->convertFormat($this->posterModel->where("email",$email)->first());
    }

    /**
     * Save the poster data to database using $email data.
     *
     * @param string $email Email address of the poster to be saved.
     *
     * @return int
     */
    public function save($email)
    {
        $this->posterModel->email = $email;
        $this->posterModel->save();
        return $this->posterModel->id;
    }


    /**
     * Converts the Eloquent object to a standard format.
     *
     * @param mixed $job
     *
     * @return stdClass
     */
    protected function convertFormat($job)
    {
        return $job ? (object) $job->toArray() : null;
    }
}