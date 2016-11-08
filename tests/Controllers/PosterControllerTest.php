<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 4.11.2016
 * Time: 15:16
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Tests\Controllers;

use JobBoard\Http\Controllers\PosterController;
use Tests\MailTracking;
use Illuminate\Support\Facades\Hash;
use JobBoard\Models\Entities\Poster;

/**
 * Class PosterControllerTest
 *
 * Test Class to test PosterController class methods
 *
 * @package Tests\Controllers
 */
class PosterControllerTest extends \TestCase
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
     * Tests PosterController::save() method.
     */
    public function testSave()
    {
        $poster = app(PosterController::class);
        $poster_id = $poster->save("tester@gmail.com");

        $this->assertInternalType("int", $poster_id);
        $this->seeEmailWasSent()
            ->seeEmailSubject('Submission In Moderation')
            ->seeEmailTo("tester@gmail.com")
            ->seeEmailContains('Your submission is in moderation! Once our board moderator approves your job post, it will be publicly available.');

        $poster->save("tester@gmail.com");
        $this->assertSame("Your submission is still in moderation!", $poster->errors['email']);

        $posterModel = Poster::where("spam", 1)->first();
        $poster->save($posterModel->email);
        $this->assertSame("Your email is tagged as spam!", $poster->errors['email']);

        $posterModel = Poster::where(array("approved" => 1, "spam" => 0))->first();
        $poster_id = $poster->save($posterModel);
        $this->assertInternalType("int", $poster_id);
    }

    /**
     * Tests PosterController::approve() method.
     */
    public function testApprove()
    {
        $poster = Poster::find(1);
        $this->visit('/posters/approve/1/' . str_replace("/", "|", (Hash::make($poster->email))))
            ->assertResponseOk()
            ->see("Poster approved successfully!");

        $this->visit('/posters/approve/1/someString')
            ->assertResponseOk()
            ->see("Poster couldn't be approved! Please use the link in the email you received.");
    }

    /**
     * Tests PosterController::spam() method.
     */
    public function testSpam()
    {
        $poster = Poster::find(1);
        $this->visit('/posters/spam/1/' . str_replace("/", "|", (Hash::make($poster->email))))
            ->assertResponseOk()
            ->see("Poster's email marked as spam!");

        $this->visit('/posters/spam/1/someString')
            ->assertResponseOk()
            ->see("Poster's email couldn't be marked as a spam! Please use the link in the email you received.");
    }
}
