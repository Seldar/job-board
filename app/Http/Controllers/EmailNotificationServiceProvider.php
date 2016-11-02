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
 * Register our Repository with Laravel
 */
class EmailNotificationServiceProvider extends ServiceProvider
{
    /**
     * Registers the jobInterface with Laravels IoC Container
     *
     */
    public function register()
    {
        // Bind the returned class to the namespace 'JobBoard\Http\Controllers\NotificationInterface'
        $this->app->bind('JobBoard\Http\Controllers\NotificationInterface', function($app)
        {
            return new EmailNotification();
        });
    }
}