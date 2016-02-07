<?php

namespace BackTo95\MongoDbCrud\Field;

abstract class Field implements FieldInterface
{
    protected $attributes = [];

    protected $name;

    protected $type;

    public function getAttributes() : array
    {
        return $this->attributes;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getType() : string
    {
        return $this->type;
    }
}
