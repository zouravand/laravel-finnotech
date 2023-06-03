# Laravel Finnotech

A package to provide finnotech api and attach them to your existed entities.

## Installation

In order to add the capability to your laravel application, you should require it via composer.

```shell
composer require tedon/laravel-finnotech
```

### Publish configuration file

By publishing configuration file, it is possible to edit predefined custom shortcut macros.

```shell
php artisan vendor:publish --provider="Tedon\LaravelFinnotech\Providers\FinnotechServiceProvider" --tag="finnotech-config"
```

## License

The Laravel Finnotech package is open-sourced software licensed under the MIT license.
