<?php

namespace BackTo95\MongoDbCrud\Field;

interface FieldInterface
{
    public function getAttributes();

    public function getName();

    public function getType();
}
