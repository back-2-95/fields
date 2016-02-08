# php-crud-fields
Generic Field API for PHP7

## Fields

- Interface and abstract class for field
- Basic field types as classes
- Configuration examples
- Utility class for creating and getting configured fields

## API

Create API and set storage:
```
$api = new \BackTo95\Fields\Api();
$storage = new \BackTo95\Storage\FileStorage('data/entities');
$api->setStorage($storage);
```
Create fields:
```
$title = (new Text(['name' => 'title', 'label' => 'Title']))->setRequired(true);
$description = new Textarea(['name' => 'description', 'label' => 'Description']);
```
Create EntityConfiguration with fields:
```
$track_configuration = new EntityConfiguration([
    'name' => 'track',
    'description' => 'Track represents musical track made with tracker software',
    'fields' => [$title, $description],
]);
```
Store the created EntityConfiguration:
```
$api->storeEntityConfiguration($track_configuration);
```
Get stored EntityConfiguration by name:
```
$api->getEntityConfiguration('track');
```

## Content type / Entity / Model

This describes some entity like Album, User, Post etc.

Entity needs flexible way to have CRUD operations and way to store them.

## Configuration data

Example: track (as in music)

````PHP
$configuration = [
    'name' => 'track',
    'description' => '',
    'fields' => [
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
    ]
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