<?php

namespace BackTo95\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;
use BackTo95\Fields\FieldStorage\FileStorage;
use BackTo95\Fields\FieldStorage\StorageInterface;
use Exception;

class API
{
    protected $storage;

    public function getEntityConfiguration(string $entity) : EntityConfiguration
    {
        return $this->getStorage()->getEntityConfiguration($entity);
    }

    public function getEntityFields(string $entity) : array
    {
        $configuration = $this->getEntityConfiguration($entity);

        if (!isset($configuration['fields'])) {
            throw new Exception(sprintf('Entity configuration for %s does not have any fields.', $entity));
        }

        foreach ($configuration['fields'] as $field_instance => $field) {
            // TODO How to map field type e.g. 'text' to class 'BackTo95\Fields\Field\Text'
            // maybe reflector class?
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

    public function storeEntityConfiguration(EntityConfiguration $configuration) : bool
    {
        return $this->getStorage()->storeEntityConfiguration($configuration);
    }
}
