<?php

namespace BackTo95\Fields\Entity;

use Exception;

class EntityConfiguration
{
    /** @var string Name of the entity e.g. "track" */
    protected $name;

    /** @var string Description of the entity */
    protected $description;

    /** @var  array List of fields attached to the entity */
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
        return isset($this->fields[$name]);
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
     * @param array $fields Fields
     * @return EntityConfiguration
     */
    public function setFields(array $fields) : self
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
     * @param array $options Options
     */
    protected function setOptions(array $options = [])
    {
        if (isset($options['name'])) {
            $this->setName($options['name']);
        }

        if (isset($options['description'])) {
            $this->setDescription($options['description']);
        }

        if (isset($options['fields']) && is_array($options['fields'])) {
            $this->setFields($options['fields']);
        }
    }

    /**
     * Validate fields and their data
     *
     * @param array $fields Fields
     * @return array Validated fields
     * @throws Exception
     */
    protected function validateFields(array $fields) : array
    {
        $validated_fields = [];
        $valid_field_attributes = ['name', 'required', 'form', 'multivalue'];

        foreach ($fields as $field) {
            if (!isset($field['name'])) {
                throw new Exception("Name is mandatory attribute for a field!");
            }

            foreach ($field as $attribute => $value) {
                if (!in_array($attribute, $valid_field_attributes)) {
                    throw new Exception(sprintf("Field attribute %s is not valid!", $attribute));
                }

                switch ($attribute) {
                    case 'required':
                        $field[$attribute] = (int) $value;
                        if ($value !== 1) {
                            throw new Exception(sprintf("Only valid values for required is 1, value of '%s' (%s) was given.", $value, gettype($value)));
                        }

                        break;
                }
                // TODO check if attribute has a validator?
            }

            $validated_fields[$field['name']] = $field;
        }
//print_r($validated_fields);
        return $validated_fields;
    }
}
