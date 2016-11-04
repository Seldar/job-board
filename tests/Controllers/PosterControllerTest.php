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

class PosterControllerTest extends \TestCase
{
    use MailTracking;

    public function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

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
    }

    public function testApprove()
    {
        $poster = Poster::find(1);
        $this->visit('/posters/approve/1/' . str_replace("/","|",(Hash::make($poster->email))))
        ->assertResponseOk()
        ->see("Poster approved successfully!");
    }

    public function testSpam()
    {
        $poster = Poster::find(1);
        $this->visit('/posters/spam/1/' . str_replace("/","|",(Hash::make($poster->email))))
            ->assertResponseOk()
            ->see("Poster's email marked as spam!");
    }
}
