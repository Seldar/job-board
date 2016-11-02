<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 1.11.2016
 * Time: 16:41
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace JobBoard\Models\Repositories\Poster;

use JobBoard\Models\Entities\Poster;
use Illuminate\Support\ServiceProvider;

/**
 * Register our Repository with Laravel
 */
class PosterRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registers the jobInterface with Laravels IoC Container
     *
     */
    public function register()
    {
        // Bind the returned class to the namespace 'JobBoard\Models\Repositories\Poster\PosterInterface'
        $this->app->bind('JobBoard\Models\Repositories\Poster\PosterInterface', function($app)
        {
            return new PosterRepository(new Poster());
        });
    }
}