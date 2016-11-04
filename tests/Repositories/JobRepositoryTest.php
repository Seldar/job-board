<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 3.11.2016
 * Time: 16:44
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Tests\Repositories;

use JobBoard\Models\Repositories\Job\JobInterface;
use JobBoard\Models\Entities\Job;
use \TestCase;

class JobRepositoryTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function testGetById()
    {
        $jobRepo = app(JobInterface::class);
        $result = $jobRepo->getById(1);

        $this->assertInstanceOf("\stdClass", $result);
        $this->assertNotEmpty($result->title);
        $this->assertNotEmpty($result->description);
        $this->assertNotEmpty($result->poster_id);
    }

    public function testGetAll()
    {
        $jobRepo = app(JobInterface::class);
        $result = $jobRepo->getAll("id", "desc", 2);
        $resultObj = array_values($result)[0];
        $this->assertTrue(is_array($result));
        $this->assertInstanceOf("\stdClass", $resultObj);
        $this->assertNotEmpty($resultObj->title);
        $this->assertNotEmpty($resultObj->description);
        $this->assertNotEmpty($resultObj->poster_id);
        $this->assertSame(3, count($jobRepo->getAll("id", "desc", 3)));
        $this->assertSame(0, count($jobRepo->getAll("id", "desc", 0)));
        $this->assertSame(5, count($jobRepo->getAll("id", "desc", 6)));
        $this->assertSame(5, count($jobRepo->getAll("id", "desc", -2)));
    }

    public function testSave()
    {
        $jobRepo = app(JobInterface::class);
        $jobRepo->save([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2
        ]);
        $this->assertSame(6, count($jobRepo->getAll("id", "desc", 6)));
    }

    public function testConvertFormat()
    {
        $jobRepo = app(JobInterface::class);
        $result = $jobRepo->convertFormat(Job::find(1));
        $this->assertInstanceOf("\stdClass", $result);
        $this->assertNotEmpty($result->title);
        $this->assertNotEmpty($result->description);
        $this->assertNotEmpty($result->poster_id);
    }
}
