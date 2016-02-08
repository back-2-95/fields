<?php

namespace BackTo95\Fields\FieldStorage;

use BackTo95\Fields\Entity\EntityConfiguration;

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
     * @return EntityConfiguration Configuration
     */
    public function getEntityConfiguration(string $entity) : EntityConfiguration;

    /**
     * Store configuration for given entity
     *
     * @param EntityConfiguration $configuration
     * @return bool
     */
    public function storeEntityConfiguration(EntityConfiguration $configuration) : bool;
}
