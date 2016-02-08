<?php

namespace BackTo95\Fields\Field;

use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;

class API
{
    protected $storage;

    public function getEntityConfiguration(string $entity) : array
    {
        return $this->getStorage()->getEntityConfiguration($entity);
    }

    public function getFields(string $entity) : array
    {
        $configuration = $this->getEntityConfiguration($entity);

        foreach ($configuration['fields'] as $field_instance => $field) {

        }
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

    public function storeEntityConfiguration(string $entity, array $configuration) : bool
    {
        return $this->getStorage()->storeEntityConfiguration($entity, $configuration);
    }
}
