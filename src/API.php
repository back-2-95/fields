<?php

namespace BackTo95\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\Field\Text;
use BackTo95\Fields\Field\Textarea;
use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;
use Exception;

class API
{
    protected $storage;

    public $field_classes = [
        'text' => Text::class,
        'textarea' => Textarea::class,
    ];

    public function __construct()
    {
        EntityConfiguration::setFieldClasses($this->getFieldClasses());
    }

    public function getEntityConfiguration(string $entity) : EntityConfiguration
    {
        return $this->getStorage()->getEntityConfiguration($entity);
    }

    public function getFieldClass(string $field_name)
    {
        if (!isset($this->field_classes[$field_name])) {
            throw new Exception(sprintf('Field type %s has no class registered to it.', $field_name));
        }

        return $this->field_classes[$field_name];
    }

    public function getFieldClasses() : array
    {
        return $this->field_classes;
    }

    public function getStorage() : StorageInterface
    {
        // Use FileStorage as default
        if (!$this->storage) {
            $this->storage = new FileStorage();
        }

        return $this->storage;
    }

    public function setStorage(StorageInterface $storage) : self
    {
        $this->storage = $storage;
        return $this;
    }

    public function storeEntityConfiguration(EntityConfiguration $configuration) : bool
    {
        return $this->getStorage()->storeEntityConfiguration($configuration);
    }
}
