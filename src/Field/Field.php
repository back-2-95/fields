<?php

namespace BackTo95\Fields\Field;

abstract class Field implements FieldInterface
{
    protected $attributes = [];

    protected $name;

    protected $settings;

    protected $type;

    public function getAttributes() : array
    {
        return $this->attributes;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getSettings() : array
    {
        return $this->settings;
    }

    public function getType() : string
    {
        return $this->type;
    }
}
