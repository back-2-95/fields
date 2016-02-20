<?php

namespace BackTo95\Fields\Storage;

use BackTo95\Fields\Entity\EntityConfiguration;
use Exception;

class FileStorage implements StorageInterface
{
    protected $path;

    static $default_path = './data/entities';

    /**
     * FileStorage constructor.
     *
     * @param string $path Writable path for the configurations
     */
    public function __construct(string $path = '')
    {
        if ($path != '') {
            $this->setPath($path);
        }
    }

    /**
     * Get configuration for wanted entity
     *
     * @param string $entity Entity name
     * @return EntityConfiguration Entity configuration
     * @throws Exception
     */
    public function getEntityConfiguration(string $entity) : EntityConfiguration
    {
        $configuration_file = sprintf('%s/%s.php', $this->getPath(), $entity);

        if (file_exists($configuration_file)) {
            /** @noinspection PhpIncludeInspection */
            $configuration = include $configuration_file;
            return new EntityConfiguration($configuration);
        }
        else {
            throw new Exception(sprintf('Configuration file %s does not exist.', $configuration_file));
        }
    }

    /**
     * Get path to configurations
     *
     * @return string Path
     */
    public function getPath() : string
    {
        if (!$this->path) {
            $this->setPath(self::$default_path);
        }

        return $this->path;
    }

    public function setPath($path) : self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Store configuration for the entity
     *
     * @param EntityConfiguration $configuration Configuration
     * @return bool Success
     * @throws Exception
     */
    public function storeEntityConfiguration(EntityConfiguration $configuration) : bool
    {
        $path = $this->getPath();

        if (is_writable($path)) {
            $configuration_file = sprintf('%s/%s.php', $path, $configuration->getName());
            $result = file_put_contents($configuration_file, '<?php return ' . var_export($configuration->getArrayCopy(), true) . ';' . PHP_EOL);
            return ($result > 0);
        }
        else {
            throw new Exception(sprintf('Configuration path %s is not writable.', $path));
        }
    }
}
