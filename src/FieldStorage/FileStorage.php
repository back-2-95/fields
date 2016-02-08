<?php

namespace BackTo95\Fields\FieldStorage;

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
            $this->path = $path;
        }
    }

    /**
     * Get configuration for wanted entity
     *
     * @param string $entity Entity name
     * @return array Entity configuration
     * @throws Exception
     */
    public function getEntityConfiguration(string $entity) : array
    {
        $configuration_file = sprintf('%s/%s.php', $this->getPath(), $entity);

        if (file_exists($configuration_file)) {
            /** @noinspection PhpIncludeInspection */
            return include $configuration_file;
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
            $this->path = self::$default_path;
        }

        return $this->path;
    }

    /**
     * Store configuration for the entity
     *
     * @param string $entity Entity name
     * @param array $configuration Configuration
     * @return bool Success
     * @throws Exception
     */
    public function storeEntityConfiguration(string $entity, array $configuration) : bool
    {
        $path = $this->getPath();

        if (is_writable($path)) {
            $configuration_file = sprintf('%s/%s.php', $path, $entity);
            $result = file_put_contents($configuration_file, '<?php return ' . var_export($configuration, true) . ';' . PHP_EOL);
            return ($result > 0);
        }
        else {
            throw new Exception(sprintf('Configuration path %s is not writable.', $path));
        }
    }
}
