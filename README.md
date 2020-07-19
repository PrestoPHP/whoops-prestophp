# Whoops-PrestoPHP

Integrates the Whoops library into PrestoPHP [whoops](https://github.com/filp/whoops)

**whoops** is an error handler base/framework for PHP. Out-of-the-box, it
provides a pretty error interface that helps you debug your web projects, 
but at heart it's a simple yet powerful stacked error handling system.

## Module installation

In your project root folder

1. `composer require prestophp/whoops-prestophp ~1.0`
2. In your PrestoPHP container configuration, register the WhoopsServiceProvider:

```php
use WhoopsPrestoPHP\WhoopsServiceProvider;
$container->register(new WhoopsServiceProvider);
```

-----

![Whoops!](http://i.imgur.com/xiZ1tUU.png)
