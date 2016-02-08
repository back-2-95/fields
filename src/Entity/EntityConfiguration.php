<?php

namespace BackTo95\Fields\Entity;

use ArrayObject;

class EntityConfiguration extends ArrayObject
{
    protected $name;
    protected $description;
    protected $fields = [];

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
