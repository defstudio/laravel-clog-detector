# Laravel Clog Detector

[![Latest Version on Packagist](https://img.shields.io/packagist/v/defstudio/laravel-clog-detector.svg?style=flat-square)](https://packagist.org/packages/defstudio/laravel-clog-detector)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/def-studio/laravel-clog-detector/run-tests.yml?branch=main&label=tests)](https://github.com/def-studio/laravel-clog-detector/actions?query=workflow%3A"Run+Tests"+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/def-studio/laravel-clog-detector/static.yml?branch=main&label=code%20style)](https://github.com/def-studio/laravel-clog-detector/actions?query=workflow%3A"Static+Analysis"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/defstudio/laravel-clog-detector.svg?style=flat-square)](https://packagist.org/packages/defstudio/laravel-clog-detector)
[![License](https://img.shields.io/packagist/l/defstudio/laravel-clog-detector)](https://packagist.org/packages/defstudio/laravel-clog-detector)


A slow responses detector for Laravel.

## Installation

You can install the package via composer:

```bash
composer require defstudio/laravel-clog-detector
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="laravel-clog-detector-config"
```

This is the contents of the published config file:

```php
return [
    'slow_responses' => [
        /*
         * Enables slow responses reporting
         */
        'report' => env('SLOW_RESPONSES_REPORT', false),

        /*
         * Max http request handling time expressed in seconds.
         */
        'threshold' => env('SLOW_RESPONSES_MAX_SECS', 5),

        /*
         * Route names that will not report a long execution time.
         */
        'ignored_routes' => [
        ],

        /*
         * Urls that will not report a long execution time.
         */
        'ignored_urls' => [
        ],

        /*
         * The middleware to be used to check response times.
         * it must implement DefStudio\ClogDetector\Contracts\MeasureHttpResponseTime
         */
        'middleware' => MeasureHttpResponseTime::class,
    ],
];

```

## Usage

[TODO]

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](./CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Fabio Ivona](https://github.com/def-studio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
