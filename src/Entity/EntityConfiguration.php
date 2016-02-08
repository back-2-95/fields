<?php

namespace BackTo95\Fields\Entity;

class EntityConfiguration
{
    protected $name;
    protected $description;
    protected $fields;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function getArrayCopy() : array
    {
        $array = [
            'name' => $this->getName(),
            'fields' => $this->fields,
        ];

        if ($this->getDescription() != '') {
            $array['description'] = $this->getDescription();
        }

        return $array;
    }

    public function getDescription() : string
    {
        return (isset($this->description)) ? $this->description : '';
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function hasField(string $name) : bool
    {
        return isset($this->fields[$name]);
    }

    protected function setOptions(array $options = [])
    {
        if (isset($options['name'])) {
            $this->name = $options['name'];
        }

        if (isset($options['description'])) {
            $this->description = $options['description'];
        }

        if (isset($options['fields']) && is_array($options['fields'])) {
            $this->fields = $options['fields'];
        }
    }
}
