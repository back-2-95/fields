<?php

namespace BackTo95\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\Storage\FileStorage;
use BackTo95\Fields\Storage\StorageInterface;

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
            // TODO set default storage in configuration
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
