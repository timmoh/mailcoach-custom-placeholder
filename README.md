# Mailcoach Custom Placeholder
[![Latest Version on Packagist](https://img.shields.io/packagist/v/timmoh/mailcoach-custom-placeholder.svg?style=flat-square)](https://packagist.org/packages/timmoh/mailcoach-custom-placeholder)
![Test Status](https://img.shields.io/github/workflow/status/timmoh/mailcoach-custom-placeholder/run-tests?label=tests)
![Code Style Status](https://img.shields.io/github/workflow/status/timmoh/mailcoach-custom-placeholder/Check%20&%20fix%20styling?label=code%20style)
[![Total Downloads](https://img.shields.io/packagist/dt/timmoh/mailcoach-custom-placeholder.svg?style=flat-square)](https://packagist.org/packages/timmoh/mailcoach-custom-placeholder)

AddOn Spatie's awesome Mailcoach (https://mailcoach.app/): Use custom placeholder like ::foo:: invidual in every email List.

## Installation

You can install the package via composer:

```bash
composer require timmoh/mailcoach-custom-placeholder
```
## Prepare Database:
Publish migrations & migrate.

```bash
php artisan vendor:publish --tag=mailcoach-custom-placeholder-migrations
php artisan migrate
```

### Publish Resources:
All Resources:
```bash
php artisan vendor:publish --tag=mailcoach-custom-placeholder
```
Or Single:
```bash
php artisan vendor:publish --tag=mailcoach-custom-placeholder-views
php artisan vendor:publish --tag=mailcoach-custom-placeholder-config
php artisan vendor:publish --tag=mailcoach-custom-placeholder-lang
```

## Add Route
File: `App\Providers\RouteServiceProvider`
```php
public function map() {
...
Route::mailcoachCustomPlaceholder($webPrefix);
//or
Route::mailcoachCustomPlaceholder('mailcoach');
...
}
```

## Usage

Add EmailListPlaceholderReplacer::class to config/mailcoach.php
```php
'replacers' => [
     \Timmoh\MailcoachCustomPlaceholder\Support\Replacers\EmailListPlaceholderReplacer::class,
    ...
],
```

Extend Email List View:
(```emailLists/layouts/partials/afterLastTab.blade.php```)
```php
<x-navigation-item :href="route('mailcoach.emailLists.placeholders', $emailList)">
    <x-icon-label icon="fa-exchange-alt" text="Placeholders" />
</x-navigation-item>
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
