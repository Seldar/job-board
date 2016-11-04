<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:29
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Poster;

/**
 * Interface PosterInterface
 *
 * Interface for poster repositories.
 *
 * @package JobBoard\Models\Repositories\Poster
 */
interface PosterInterface
{
    /**
     * Returns the Poster object associated with the passed email.
     *
     * @param string $email email of the poster to be retrieved
     *
     * @return \stdClass
     */
    public function getByEmail($email);

    /**
     * Save the poster data to database using $email data.
     *
     * @param string $email email of the poster to be saved
     *
     * @return mixed
     */
    public function save($email);
}