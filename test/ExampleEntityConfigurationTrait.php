<?php

namespace BackTo95Test\Fields;

use BackTo95\Fields\Entity\EntityConfiguration;

trait ExampleEntityConfigurationTrait
{
    protected $example_data = [
        'name' => 'track',
        'description' => 'Track represents musical track made with tracker software',
        'fields' => [
            'artist' => [
                'name' => 'artist',
                'form' => [
                    'widget' => 'text',
                    'filters' => ['trim'],
                ],
                'required' => 1,
            ],
            'title' => [
                'name' => 'title',
                'form' => [
                    'widget' => 'text',
                ],
                'required' => 1,
            ],
            'description' => [
                'name' => 'description',
                'form' => [
                    'widget' => 'editor',
                ],
            ],
            'cover' => [
                'name' => 'cover',
                'form' => [
                    'widget' => 'image',
                ],
            ],
            'genre' => [
                'name' => 'genre',
                'form' => [
                    'widget' => 'tags',
                    'validators' => [
                        'min' => 1
                    ],
                ],
                'multivalue' => 1,
                'required' => 1,
            ],
        ]
    ];

    protected function getExampleConfiguration()
    {
        return new EntityConfiguration($this->example_data);
    }

    protected function getInvalidExampleConfiguration()
    {
        $data = $this->example_data;
        unset($data['fields']['genre']['name']);
        $data['fields']['genre']['required'] = 2;
        return new EntityConfiguration($data);
    }
}
