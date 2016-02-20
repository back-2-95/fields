<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\API;
use BackTo95\Fields\Storage\FileStorage;
use BackTo95\Fields\Storage\StorageInterface;
use PHPUnit_Framework_TestCase as TestCase;

class StorageTest extends TestCase
{
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

    public function testStoreEntityConfiguration()
    {
        $configuration = $this->getExampleConfiguration();
        $path = $this->storage->getPath();

        $this->api->storeEntityConfiguration($configuration);

        $configuration_file = sprintf('%s/%s.php', $path, $configuration->getName());
        $this->assertFileExists($configuration_file);
    }

    public function testGetEntityConfiguration()
    {
        $entity_name = 'track';
        $path = $this->storage->getPath();
        $configuration_file = sprintf('%s/%s.php', $path, $entity_name);

        $configuration = $this->api->getEntityConfiguration($entity_name);

        $this->assertFileExists($configuration_file);
        $this->assertEquals(EntityConfiguration::class, get_class($configuration));
        $this->assertEquals($entity_name, $configuration->getName());
        $this->assertTrue($configuration->hasField('title'));
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

    protected function getExampleConfiguration()
    {
        return new EntityConfiguration([
            'name' => 'track',
            'description' => 'Track represents musical track made with tracker software',
            'fields' => [
                'artist' => [
                    'name' => 'artist',
                    'widget' => 'text',
                    'required' => true,
                ],
                'title' => [
                    'name' => 'title',
                    'widget' => 'text',
                    'required' => true,
                ],
                'description' => [
                    'name' => 'description',
                    'widget' => 'textarea',
                ],
                'cover' => [
                    'name' => 'cover',
                    'widget' => 'image',
                ],
                'genre' => [
                    'name' => 'genre',
                    'widget' => 'tags',
                    'required' => true,
                    'settings' => [
                        'min' => 1
                    ]
                ],
            ]
        ]);
    }
}
