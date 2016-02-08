<?php

namespace BackTo95\Fields\FieldStorage;

/**
 * Interface StorageInterface
 *
 * Implement this interface to create alternative storage for Field configurations
 *
 * @package BackTo95\Fields\FieldStorage
 */
interface StorageInterface
{
    /**
     * Get configuration for given entity
     *
     * @param string $entity
     * @return array Configuration
     */
    public function getEntityConfiguration(string $entity) : array;

    /**
     * Store configuration for given entity
     *
     * @param string $entity
     * @param array $configuration
     * @return bool
     */
    public function storeEntityConfiguration(string $entity, array $configuration) : bool;
}
