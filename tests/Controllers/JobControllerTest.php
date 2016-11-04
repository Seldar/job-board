<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 4.11.2016
 * Time: 13:51
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Tests\Controllers;

use \TestCase;
use Tests\MailTracking;

class JobControllerTest extends TestCase
{
    use MailTracking;

    public function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function testCreate()
    {
        $this->visit('/jobs/create')
            ->see('Post Job');
    }

    public function testStore()
    {
        $this->visit('/jobs/create')
            ->type('Test Title', 'title')
            ->type('Test Description', 'description')
            ->type('testemail@gmail.com', 'email')
            ->type(csrf_token(),'_token')
            ->press('Post')
            ->seePageIs('/jobs')
            ->seeEmailWasSent()
            ->seeEmailSubject('New Submission')
            ->seeEmailTo('moderator@job-board.com')
            ->seeEmailContains('A new user posted a job. Please review and approve or mark it as a spam accordingly.');
    }

    public function testIndex()
    {
        $this->visit('/jobs')
            ->see('Job List')
            ->see('test@gmail.com');
    }

    public function testShow()
    {
        $this->visit('/jobs/2')
            ->see('Job Details')
            ->see('test@gmail.com');
    }
}
