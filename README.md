Phariscope Safe PHP
========

A set of core PHP functions rewritten to throw exceptions instead of returning `false` when an error is encountered.

These functions complement those of the excellent SafePHP tool https://github.com/thecodingmachine/safe.

# Installation

```console
composer require phariscope/safephp
```

# Usage

```php
use function SafePHP\boolval;
use function SafePHP\floatval;
use function SafePHP\intval;
use function SafePHP\strval;

$value = boolval(1); // return true
$value = floatval("123.456"); // return 123.456
$value = intval("123"); // return 123
$value = strval(1); // return "1"
```

# To Contribute to phariscope/SafePHP

## Requirements

* docker
* git

## Install

* git clone git@github.com:phariscope/Event.git

## Unit test

```console
bin/phpunit
```

Using Test-Driven Development (TDD) principles (thanks to Kent Beck and others), following good practices (thanks to Uncle Bob and others).

## Quality

* phpcs PSR12
* phpstan level 9
* coverage 100%
* infection MSI >99%

Quick check with:
```console
./codecheck
```

Check coverage with:
```console
bin/phpunit --coverage-html var
```
and view 'var/index.html' with your browser

Check infection with:
```console
bin/infection
```
and view 'var/infection.html' with your browser