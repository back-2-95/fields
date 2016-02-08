<?php

namespace BackTo95\Fields\Entity;

use ArrayObject;
use BackTo95\Fields\Field\Field;

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
        ];

        if ($this->getDescription() != '') {
            $array['description'] = $this->getDescription();
        }

        /**
         * @var string $field_instance
         * @var Field $field
         */
        foreach ($this->fields as $field_instance => $field) {
            $this->fields[$field_instance] = $field->getArrayCopy();
        }

        $array['fields'] = $this->fields;

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
