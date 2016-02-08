<?php

namespace BackTo95Test\Fields;

use ArrayObject;
use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\API;
use BackTo95\Fields\Field\Text;
use BackTo95\Fields\Field\Textarea;
use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;
use PHPUnit_Framework_TestCase as TestCase;

class FieldStorageTest extends TestCase
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
        //$this->assertArrayHasKey('fields', $configuration);
        //$this->assertEquals($entity_name, $configuration['name']);
        //$this->assertEquals('text', $configuration['fields']['title']['field']);
    }

    public function testAddFieldToEntityConfiguration()
    {
        $configuration = $this->getExampleConfiguration();
        $some_field = new Textarea(['name' => 'some_field', 'label' => 'Additional information']);

        $configuration->addField($some_field);
        //$field_names = $configuration->getFieldNames();print_r($field_names);
        //$this->assert('some_field', $field_names, var_dump($field_names));
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
