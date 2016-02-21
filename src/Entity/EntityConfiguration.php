<?php

namespace BackTo95\Fields\Entity;

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
        $this->fields = $fields;
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
}
