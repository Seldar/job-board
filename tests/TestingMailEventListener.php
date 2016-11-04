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
use Swift_Events_SendEvent;

/**
 * Class TestingMailEventListener
 *
 * Event Listener for swift mailer
 *
 * @package Tests
 */
class TestingMailEventListener implements Swift_Events_EventListener
{
    /**
     * Test class
     *
     * @var \TestCase
     */
    protected $test;

    /**
     * TestingMailEventListener constructor.
     *
     * @param \TestCase $test
     */
    public function __construct(\TestCase $test)
    {
        $this->test = $test;
    }

    /**
     * Method to handle when the Event fired
     *
     * @param Swift_Events_SendEvent $event
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $event)
    {
        $this->test->addEmail($event->getMessage());
    }
}