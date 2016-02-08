<?php

namespace BackTo95\Fields\Entity;

use BackTo95\Fields\Field\Field;

class EntityConfiguration
{
    protected $name;
    protected $description;
    protected $fields;
    protected static $field_classes = [];

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function addField(Field $field) : self
    {
        $this->fields[$field->getName()] = $field;
        return $this;
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
         * @var Field $field
         */
        foreach ($this->fields as $field) {
            $array['fields'][$field->getName()] = $field->getArrayCopy();
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

    public static function setFieldClasses(array $classes)
    {
        self::$field_classes = $classes;
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
            foreach ($options['fields'] as $field) {
                if (is_array($field)) {
                    $class = self::$field_classes[$field['field']];
                    $field = new $class($field);
                }

                $this->addField($field);
            }
        }
    }
}
