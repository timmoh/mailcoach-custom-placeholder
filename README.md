# Mailcoach Custom Placeholder

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require timmoh/mailcoach-custom-placeholder
```
## Prepare Database:
Publish migrations & migrate.

```bash
php artisan vendor:publish  --tag=mailcoach-api-migrations
php artisan migrate
```

### Publish Views:
```bash
php artisan vendor:publish  --tag=mailcoach-api-views
```

## Usage

Add EmailListPlaceholderReplacer::class to config/mailcoach.php
```php
'replacers' => [
     ...
     \TIMMOH\MailcoachCustomPlaceholderSupport\Support\Replacers\EmailListPlaceholderReplacer::class,
],

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email timo@doersching.net instead of using the issue tracker.

## Credits

- [Timo Dörsching](https://github.com/timmoh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
