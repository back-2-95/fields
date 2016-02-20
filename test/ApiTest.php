<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\API;
use BackTo95\Fields\Storage\FileStorage;
use PHPUnit_Framework_TestCase as TestCase;

class ApiTest extends TestCase
{
    /** @var API Fields API */
    protected $api;

    public function setUp()
    {
        $this->api = new API;
    }

    public function testSetStorage()
    {
        $storage = new FileStorage();
        $this->api->setStorage($storage);

        $this->assertInstanceOf(FileStorage::class, $this->api->getStorage());
    }
}
