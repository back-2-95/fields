<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\API;
use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\Storage\FileStorage;
use PHPUnit_Framework_TestCase as TestCase;

class ApiTest extends TestCase
{
    use ExampleEntityConfigurationTrait;

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

    public function testStoreEntityConfiguration()
    {
        $configuration = $this->getExampleConfiguration();
        $path = $this->api->getStorage()->getPath();

        $this->api->storeEntityConfiguration($configuration);

        $configuration_file = sprintf('%s/%s.php', $path, $configuration->getName());
        $this->assertFileExists($configuration_file);
    }

    public function testGetEntityConfiguration()
    {
        $entity_name = 'track';
        $path = $this->api->getStorage()->getPath();
        $configuration_file = sprintf('%s/%s.php', $path, $entity_name);

        $configuration = $this->api->getEntityConfiguration($entity_name);

        $this->assertFileExists($configuration_file);
        $this->assertEquals(EntityConfiguration::class, get_class($configuration));
        $this->assertEquals($entity_name, $configuration->getName());
        $this->assertTrue($configuration->hasField('title'));
    }

    public function testGetInvalidEntityConfiguration()
    {
        $this->expectException(\Exception::class);
        $configuration = $this->getInvalidExampleConfigurationNoName();

        $this->expectException(\Exception::class);
        $configuration = $this->getInvalidExampleConfigurationNotValidAttribute();
    }

    public function testGetEntityConfigurations()
    {
        $configurations = $this->api->getEntityConfigurations();
        $this->assertArrayHasKey('track', $configurations);
    }
}
