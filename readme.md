Job Board Application [![Build Status](https://travis-ci.org/Seldar/job-board.svg?branch=master)](https://travis-ci.org/Seldar/job-board)
=====================

The "Job Board Application" is a laravel application which enables a user to post a job which in return could be approved or marked as spam by a moderator utilizing emails. The published job posts could also be browsed.

Requirements
------------

  * PHP 5.3 or higher;
  * [Laravel 5.3.*](https://github.com/laravel/laravel)
  * [guzzlehttp/guzzle ^6.2](https://packagist.org/packages/guzzlehttp/guzzle)
  * [PHPUnit 5.4](https://github.com/sebastianbergmann/phpunit) or higher.

Installation
------------


Install using composer:

```bash
$ composer install
```

Run Database Seeds for sample data:

```bash
php artisan db:seed
```

Usage
-----

After installation point your browser to "public/" directory. You can list and post jobs through the UI. UnitTests can be run in tests/ folder.