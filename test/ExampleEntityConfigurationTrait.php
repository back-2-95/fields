<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;

trait ExampleEntityConfigurationTrait
{
    protected function getExampleConfiguration()
    {
        return new EntityConfiguration([
            'name' => 'track',
            'description' => 'Track represents musical track made with tracker software',
            'fields' => [
                'artist' => [
                    'name' => 'artist',
                    'widget' => 'text',
                    'required' => true,
                ],
                'title' => [
                    'name' => 'title',
                    'widget' => 'text',
                    'required' => true,
                ],
                'description' => [
                    'name' => 'description',
                    'widget' => 'textarea',
                ],
                'cover' => [
                    'name' => 'cover',
                    'widget' => 'image',
                ],
                'genre' => [
                    'name' => 'genre',
                    'widget' => 'tags',
                    'required' => true,
                    'settings' => [
                        'min' => 1
                    ]
                ],
            ]
        ]);
    }
}
