<?php

namespace BackTo95\Fields\Storage;

use BackTo95\Fields\Entity\EntityConfiguration;

/**
 * Interface StorageInterface
 *
 * Implement this interface to create alternative storage for Field configurations
 *
 * @package BackTo95\Fields\Storage
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
     * Get list of available entity configurations
     *
     * @return array List
     */
    public function getEntityConfigurations() : array;

    /**
     * Store configuration for given entity
     *
     * @param EntityConfiguration $configuration
     * @return bool
     */
    public function storeEntityConfiguration(EntityConfiguration $configuration) : bool;
}
