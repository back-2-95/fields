<?php

namespace BackTo95\Fields\Field;

use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;

class API
{
    protected $storage;

    public function getConfiguration(string $entity) : array
    {
        return $this->getStorage()->getConfiguration($entity);
    }

    public function getFields(string $entity) : array
    {
        $configuration = $this->getConfiguration($entity);
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

    public function storeConfiguration(string $entity, array $configuration) : bool
    {
        return $this->getStorage()->storeConfiguration($entity, $configuration);
    }
}
