<?php

namespace BackTo95\Fields\Entity;

use Exception;
use Zend\Config\Config;

class EntityConfiguration
{
    /** @var string Name of the entity e.g. "track" */
    protected $name;

    /** @var string Description of the entity */
    protected $description;

    /** @var Config List of fields attached to the entity */
    protected $fields;

    public function __construct(array $options = [])
    {
        $config = new Config($options, true);
        $this->setOptions($config);
    }

    public function getArrayCopy() : array
    {
        $array = [
            'name' => $this->getName(),
            'fields' => $this->fields->toArray(),
        ];

        if ($this->getDescription() != '') {
            $array['description'] = $this->getDescription();
        }

        return $array;
    }

    /**
     * Get entity description
     *
     * @return string Description
     */
    public function getDescription() : string
    {
        return (isset($this->description)) ? $this->description : '';
    }

    /**
     * Get entity name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Check if entity has field
     *
     * @param string $name Field
     * @return bool Has
     */
    public function hasField(string $name) : bool
    {
        return $this->fields->offsetExists($name);
    }

    /**
     * Set entity description
     *
     * @param string $description Description
     * @return EntityConfiguration
     */
    public function setDescription(string $description) : self
    {
        $this->description = trim($description);
        return $this;
    }

    /**
     * Set entity fields
     *
     * @param Config $fields Fields
     * @return EntityConfiguration
     */
    public function setFields(Config $fields) : self
    {
        $this->fields = $this->validateFields($fields);
        return $this;
    }

    /**
     * Set entity name
     *
     * @param string $name Name
     * @return EntityConfiguration
     */
    public function setName(string $name) : self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Set options
     *
     * @param Config $options Options
     */
    protected function setOptions(Config $options)
    {
        if ($options->offsetExists('name')) {
            $this->setName($options->get('name'));
        }

        if ($options->offsetExists('description')) {
            $this->setDescription($options->get('description'));
        }

        if ($options->offsetExists('fields')) {
            $this->setFields($options->get('fields'));
        }
    }

    /**
     * Validate fields and their data
     *
     * @param Config $fields Fields
     * @return Config Validated fields
     * @throws Exception
     */
    protected function validateFields(Config $fields) : Config
    {
        $valid_field_attributes = ['name', 'required', 'form', 'multivalue'];

        /** @var Config $field */
        foreach ($fields as $field) {
            if (!$field->offsetExists('name')) {
                throw new Exception("Name is mandatory attribute for a field!");
            }

            foreach ($field as $attribute => $value) {
                if (!in_array($attribute, $valid_field_attributes)) {
                    throw new Exception(sprintf("Field base attribute %s is not valid!", $attribute));
                }

                switch ($attribute) {
                    case 'required':
                        $field->offsetSet($attribute, (int) $value);
                        if ($value !== 1) {
                            throw new Exception(sprintf("Only valid values for required is 1, value of '%s' (%s) was given.", $value, gettype($value)));
                        }

                        break;
                }
                // TODO check if attribute has a validator?
            }
        }

        $fields->setReadOnly();

        return $fields;
    }
}
