<?php

namespace BackTo95\Fields\FieldStorage;

interface StorageInterface
{
    /**
     * Get configuration for given entity
     *
     * @param string $entity
     * @return array Configuration
     */
    public function getConfiguration(string $entity) : array;

    /**
     * Store configuration for given entity
     *
     * @param string $entity
     * @param array $configuration
     * @return bool
     */
    public function storeConfiguration(string $entity, array $configuration) : bool;
}
