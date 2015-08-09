Code Generator for Orchestra Platform
==============

[![Latest Stable Version](https://img.shields.io/github/release/orchestral/studio.svg?style=flat-square)](https://packagist.org/packages/orchestra/studio)
[![Total Downloads](https://img.shields.io/packagist/dt/orchestra/studio.svg?style=flat-square)](https://packagist.org/packages/orchestra/studio)
[![MIT License](https://img.shields.io/packagist/l/orchestra/studio.svg?style=flat-square)](https://packagist.org/packages/orchestra/studio)
[![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/orchestral/studio/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/orchestral/studio/)

## Table of Content

* [Installation](#installation)
* [Configuration](#configuration)

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "orchestra/studio": "~3.0"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "orchestra/studio=~3.0"

## Configuration

Add following service providers in `config/app.php`.

```php
'providers' => [

    // ...

    Orchestra\Studio\StudioServiceProvider::class,
],
```
