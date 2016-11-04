<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 4.11.2016
 * Time: 15:53
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */
namespace Tests;

use Swift_Events_EventListener;

class TestingMailEventListener implements Swift_Events_EventListener
{
    protected $test;
    public function __construct($test)
    {
        $this->test = $test;
    }
    public function beforeSendPerformed($event)
    {
        $this->test->addEmail($event->getMessage());
    }
}