<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:29
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Poster;

use Illuminate\Http\Request;

interface PosterInterface
{
    public function getAll(array $order, $limit);

    public function getByEmail($email);

    public function save($email);
}