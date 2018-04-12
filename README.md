Laravel Exception Slacker
==========================
The Laravel Exception Slacker is a Laravel Package, that informs you via Slack if an Exception is thrown.

Installing
==========

Add the dependency to your project:

```bash
composer require alexlg89/laravel-exception-slacker
```

Since Laravel 5.5 the service provider will autmatically get registered. In older versions you have to add the Service Provider to the `config/app.php`


```php
'providers' => [
    // ...
    Alexlg89\LaravelExceptionSlacker\LaravelExceptionSlackerServiceProvider::class,
];
```

Publish the config file with:

```bash
php artisan vendor:publish --provider="Alexlg89\LaravelExceptionSlacker\LaravelExceptionSlackerServiceProvider"
```

The value `slack_webhook_url` is the URL to your Slack Webhook.

That's it!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.