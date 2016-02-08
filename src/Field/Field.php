<?php

namespace BackTo95\Fields\Field;

use ArrayObject;
use Exception;

abstract class Field extends ArrayObject implements FieldInterface
{
    protected $name;

    protected $options = [];

    protected $required = false;

    protected $settings = [];

    protected $type;

    public function __construct(array $configuration = [])
    {
        $this->setOptions($configuration);
    }

    public function getArrayCopy()
    {
        return [
            'field' => $this->getType(),
            'options' => $this->getOptions(),
            'required' => $this->isRequired(),
        ];
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getOptions() : array
    {
        return $this->options;
    }

    public function getSettings() : array
    {
        return $this->settings;
    }

    public function getType() : string
    {
        if (!$this->type) {
            throw new Exception('This field has not type set!');
        }

        return $this->type;
    }

    public function isRequired() : bool
    {
        return $this->required;
    }

    public function setOptions(array $options) : self
    {
        if (isset($options['label'])) {
            $this->options['label'] = (string) $options['label'];
        }

        return $this;
    }

    public function setRequired(bool $state = true) : self
    {
        $this->required = $state;
        return $this;
    }
}
