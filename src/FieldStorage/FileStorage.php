<?php

namespace BackTo95\Fields\FieldStorage;

class FileStorage implements StorageInterface
{
    protected $path;

    static $default_path = './data/entities';

    public function __construct(string $path = '')
    {
        if ($path != '') {
            $this->path = $path;
        }
    }

    public function getConfiguration(string $entity) : array
    {
        $configuration_file = sprintf('%s/%s.php', $this->getPath(), $entity);

        if (file_exists($configuration_file)) {
            return include $configuration_file;
        }
        else {
            throw new \Exception(sprintf('Configuration file %s does not exist.', $configuration_file));
        }
    }

    public function getPath() : string
    {
        if (!$this->path) {
            $this->path = self::$default_path;
        }

        return $this->path;
    }

    public function storeConfiguration(string $entity, array $configuration) : bool
    {
        $path = $this->getPath();

        if (is_writable($path)) {
            $configuration_file = sprintf('%s/%s.php', $path, $entity);
            $result = file_put_contents($configuration_file, '<?php return ' . var_export($configuration, true) . ';' . PHP_EOL);
            return ($result) ? true : false;
        }
        else {
            throw new \Exception(sprintf('Configuration path %s is not writable.', $path));
        }
    }
}
