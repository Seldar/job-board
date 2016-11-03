<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 2.11.2016
 * Time: 12:44
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Http\Controllers;


/**
 * Interface NotificationInterface
 *
 * Interface for different notification methods.
 *
 * @package JobBoard\Http\Controllers
 */
interface NotificationInterface
{
    /**
     * Sends notification to $to using $content and $params to build the notification.
     *
     * @param string $content content to use for building the notification
     * @param string $to notification recipient
     * @param array $params additional parameters to use for building the notification
     * @return mixed
     */
    public function sendNotification($content, $to, array $params);
}