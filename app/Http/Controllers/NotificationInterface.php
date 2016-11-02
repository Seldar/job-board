<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 2.11.2016
 * Time: 12:44
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Http\Controllers;


interface NotificationInterface
{
    public function sendNotification($content, $to, $params);
}