<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\API;
use BackTo95\Fields\Field\Text;
use BackTo95\Fields\Field\Textarea;
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

    public function testAddFieldToEntityConfiguration()
    {
        $configuration = $this->getExampleConfiguration();
        $some_field = new Textarea(['name' => 'some_field', 'label' => 'Additional information']);

        $configuration->addField($some_field);
        $this->assertTrue($configuration->hasField('some_field'));
    }

    protected function getExampleConfiguration()
    {
        $title = (new Text(['name' => 'title', 'label' => 'Title']))->setRequired(true);
        $description = new Textarea(['name' => 'description', 'label' => 'Description']);

        return new EntityConfiguration([
            'name' => 'track',
            'description' => 'Track represents musical track made with tracker software',
            'fields' => [$title, $description],
        ]);
    }
}
