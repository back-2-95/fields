<?php

namespace BackTo95Test\Fields\Storage;

use BackTo95\Fields\API;
use BackTo95\Fields\Storage\FileStorage;
use BackTo95\Fields\Storage\StorageInterface;
use BackTo95Test\Fields\ExampleEntityConfigurationTrait;
use PHPUnit_Framework_TestCase as TestCase;

class StorageTest extends TestCase
{
    use ExampleEntityConfigurationTrait;

    /** @var API Fields API */
    protected $api;

    /** @var FileStorage Default Fields Storage */
    protected $storage;

    public function setUp()
    {
        $this->api = new API;
        $this->storage = $this->api->getStorage();
    }

    public function testGetDefaultStorage()
    {
        $this->assertInstanceOf(StorageInterface::class, $this->storage);
        $this->assertInstanceOf(FileStorage::class, $this->storage);
    }

    public function testDefaultStoragePath()
    {
        $path = $this->storage->getPath();
        $this->assertEquals($path, FileStorage::$default_path);
    }

    public function testDefaultStoragePathNotWritable()
    {
        $this->expectException(\Exception::class);
        $this->storage->setPath('/not/writable/path/i/guess');
        $configuration = $this->getExampleConfiguration();
        $this->api->storeEntityConfiguration($configuration);
    }

    public function testGetEntityConfigurationNotFound()
    {
        $this->expectException(\Exception::class);
        $configuration = $this->api->getEntityConfiguration('foobar');
    }

    public function testSetPathWithConstructor()
    {
        $storage = new FileStorage(FileStorage::$default_path);
        $path = $this->storage->getPath();
        $this->assertEquals($path, FileStorage::$default_path);
    }
}
