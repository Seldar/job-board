<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:41
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Job;

use JobBoard\Models\Entities\Job;
use Illuminate\Support\ServiceProvider;

/**
 * Register our Repository with Laravel
 */
class JobRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registers the jobInterface with Laravels IoC Container
     *
     */
    public function register()
    {
        // Bind the returned class to the namespace 'JobBoard\Models\Repositories\Job\JobInterface'
        $this->app->bind('JobBoard\Models\Repositories\Job\JobInterface', function($app)
        {
            return new JobRepository(new Job());
        });
    }
}