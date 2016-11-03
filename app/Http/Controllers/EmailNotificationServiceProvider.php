<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 2.11.2016
 * Time: 13:57
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Http\Controllers;

use Illuminate\Support\ServiceProvider;

/**
 * Registers Email notification service with Laravel.
 */
class EmailNotificationServiceProvider extends ServiceProvider
{
    /**
     * Registers the NotificationInterface with Laravels IoC Container.
     *
     * @return void
     */
    public function register()
    {
        // Bind the returned class to the namespace 'JobBoard\Http\Controllers\NotificationInterface'
        $this->app->bind('JobBoard\Http\Controllers\NotificationInterface', function ($app) {
            return new EmailNotification();
        });
    }
}