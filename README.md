# Log activities in codeigniter 4.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amol/reactiveci4.svg?style=flat-square)](https://packagist.org/packages/amol/reactiveci4)

The `amol/reactiveci4` helps to log activities of user in your website easily. It stores all activities in database table `activity`.
It helps to boost your work speed.

#### Features
1. Easy setup.
2. Use Codeigniter Models.
3. Easy to use.

## Basic Example
```php
helper('reactive');
reactive($user, "You updated the profile");
```

## Advanced Example using Class
```php
use Amol\ReactiveCi4\Reactive;

$userModel = model('App\Models\UserModel');
$user = $userModel->find(1);
$properties = [
    "ip" => "127.0.0.1"
];
$label = "profile review"

$record = new Reactive();
$record->log($user, "admin changed user's profile photo", $admin, $properties, $label);
```

## Installation
you can install the package via composer.
```bash
composer require amol/reactiveci4
```

After installing. run `spark` command
```bash
php spark reactive:setup
```
it will create `Reactive` config and `Activity` model file.
it also migrate `activity` table.

## Documentation and Examples

### Class Reactive
has function `log`
```php
public function log(object $subject, string $text, object $causer=null,array $properties=[], string $label=null ): id|false
```
### Helper
It also provides helper
```php
function reactive(object $subject, string $text, object $causer=null,array $properties=[], string $label=null )
```
return id of activity instance or false on failure.

### `Activity` Model
You can use model to retrieve data from activity table and also do crud operations with it. You can also customize the model.

### Label
Label used to categories the record in different groups.
You can change its default value using config file.

## Full documentation and Examples
Coming soon

## Bugs & Issues
If you find any bugs. Dont hesitate to create a [issue](https://github.com/AmolKumarGupta/ReactiveCi4/issues).

## Contributing
Please see [CONTRIBUTING](https://github.com/AmolKumarGupta/ReactiveCi4/blob/master/CONTRIBUTING.md) for details.
