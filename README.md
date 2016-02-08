# php-crud-fields
Generic Field API for PHP7

## Fields

- Interface and abstract class for field
- Basic field types as classes
- Configuration examples
- Utility class for creating and getting configured fields

## Content type / Entity / Model

This describes some entity like Album, User, Post etc.

Entity needs flexible way to have CRUD operations and way to store them.

## Configuration

Example: track (as in music)

````PHP
'track' = [
    'artist' => [
        'field' => 'text',
        'required' => true,
    ],
    'title' => [
        'field' => 'text',
        'required' => true,
    ],
    'description' => [
        'field' => 'textarea',
        'required' => false,
    ],
    'cover' => [
        'field' => 'image',
        'required' => false,
    ],
    'genre' => [
        'field' => 'tags',
        'required' => true,
        'settings' => [
            'min' => 1
        ]
    ],
],
````

## Output

This library should just return entities and their field configurations which can be then used by some other component to store, render, validate etc.


## Rendering ##

Rendering is not responsibility of this class.

## UI for creating configurations ##

UI is not part of this library. It should be another library which requires this.

## Storage ##

Storing this configuration is not part of this library e.g. https://github.com/back-2-95/php-mongodb-crud

This library provides interface for Storage adapters and file based solution as an example.

By default this adapter uses path `data/entities` for storing configurations.

## Examples of the fields ##

### Text ###

Text...

### Select ###

Select...

### Image

Image is a field type which is input type=file element but having attributes and functionality related to images.