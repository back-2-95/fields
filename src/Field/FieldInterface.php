<?php

namespace BackTo95\Fields\Field;

interface FieldInterface
{
    public function getOptions();

    public function getName();

    public function getType();
}
