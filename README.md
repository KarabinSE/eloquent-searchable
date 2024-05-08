# Easily search eloquent models and their relations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/karabinse/eloquent-searchable.svg?style=flat-square)](https://packagist.org/packages/karabinse/eloquent-searchable)

## Installation

You can install the package via composer:

```bash
composer require karabinse/eloquent-searchable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="eloquent-searchable-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="eloquent-searchable-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="eloquent-searchable-views"
```

## Usage

```php
$searchable = new Karabin\Searchable();
echo $searchable->echoPhrase('Hello, Karabin!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Albin N](https://github.com/KarabinSE)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
