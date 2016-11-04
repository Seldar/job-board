<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 4.11.2016
 * Time: 12:27
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Tests\Repositories;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use JobBoard\Models\Repositories\Poster\PosterInterface;
use JobBoard\Models\Entities\Poster;
use \TestCase;
use Illuminate\Support\Facades\URL;

class PosterRepositoryTest extends TestCase
{

    protected function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function testGetByEmail()
    {
        $posterRepo = app(PosterInterface::class);
        $result = $posterRepo->getByEmail('test@gmail.com');

        $this->assertInstanceOf("\stdClass", $result);
        $this->assertSame('test@gmail.com', $result->email);
        $this->assertInternalType("int", $result->approved);
        $this->assertInternalType("int", $result->spam);
    }

    public function testSave()
    {
        $posterRepo = app(PosterInterface::class);
        $result = $posterRepo->save('test2@gmail.com');
        $this->assertInternalType("int", $result);
    }

    public function testConvertFormat()
    {
        $posterRepo = app(PosterInterface::class);
        $result = $posterRepo->convertFormat(Poster::where("email",'test@gmail.com')->first());
        $this->assertInstanceOf("\stdClass", $result);
        $this->assertSame('test@gmail.com', $result->email);
        $this->assertInternalType("int", $result->approved);
        $this->assertInternalType("int", $result->spam);
    }

}
