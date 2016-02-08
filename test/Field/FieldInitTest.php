<?php

namespace BackTo95Test\MongoDbCrud;

use PHPUnit_Framework_TestCase as TestCase;
use BackTo95\Fields\Field\FieldInterface;
use BackTo95\Fields\Field\Field;
use BackTo95\Fields\Field\Text;
use BackTo95\Fields\Field\Textarea;

class FieldInitTest extends TestCase
{
    /**
     * Test all field classes that they implements the FieldInterface and are extended from
     * abstract Field class
     */
    public function testFieldsClassInstanceOf()
    {
        $field_classes = [
            Text::class,
            Textarea::class,
        ];

        foreach ($field_classes as $class) {
            $class = new $class;
            $this->assertInstanceOf(FieldInterface::class, $class);
            $this->assertInstanceOf(Field::class, $class);
        }
    }
}
