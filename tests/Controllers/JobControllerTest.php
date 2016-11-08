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
use JobBoard\Models\Entities\Poster;

/**
 * Class JobControllerTest
 *
 * Test Class to test JobController class methods
 *
 * @package Tests\Controllers
 */
class JobControllerTest extends TestCase
{
    use MailTracking;

    /**
     * Sets up the database fixture and the environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    /**
     * Tests JobController::create() method.
     */
    public function testCreate()
    {
        $this->visit('/jobs/create')
            ->see('Post Job');
    }

    /**
     * Tests JobController::store() method
     */
    public function testStore()
    {
        $this->visit('/jobs/create')
            ->type('Test Title', 'title')
            ->type('Test Description', 'description')
            ->type('testemail@gmail.com', 'email')
            ->type(csrf_token(), '_token')
            ->press('Post')
            ->seePageIs('/jobs')
            ->seeEmailWasSent()
            ->seeEmailSubject('New Submission')
            ->seeEmailTo('moderator@job-board.com')
            ->seeEmailContains('A new user posted a job. Please review and approve or mark it as a spam accordingly.');

        $poster = Poster::where("spam",1)->first();

        $this->visit('/jobs/create')
            ->type('Test Title', 'title')
            ->type('Test Description', 'description')
            ->type('testemail@gmail.com', 'email')
            ->type(csrf_token(), '_token')
            ->press('Post')
            ->seePageIs('/jobs/create')
            ->see('Your submission is still in moderation!');

        $this->visit('/jobs/create')
            ->type('Test Title', 'title')
            ->type('Test Description', 'description')
            ->type($poster->email, 'email')
            ->type(csrf_token(), '_token')
            ->press('Post')
            ->seePageIs('/jobs/create')
            ->see('Your email is tagged as spam!');

        $this->visit('/jobs/create')
            ->press('Post')
            ->seePageIs('/jobs/create')
            ->see('Please enter your email address!');
    }

    /**
     * Tests JobController::index() method
     */
    public function testIndex()
    {
        $this->visit('/jobs')
            ->see('Job List')
            ->see('test@gmail.com');
    }

    /**
     * Tests JobController::show() method
     */
    public function testShow()
    {
        $this->visit('/jobs/2')
            ->see('Job Details')
            ->see('test@gmail.com');
    }
}
