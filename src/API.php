<?php

namespace BackTo95\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;

class API
{
    protected $storage;

    public function getEntityConfiguration(string $entity) : EntityConfiguration
    {
        return $this->getStorage()->getEntityConfiguration($entity);
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
