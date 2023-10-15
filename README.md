# Installation

```console
composer require phariscope/SafePHP
```

# Usage

```php
use function SafePHP\strVal;
use function SafePHP\strInt;

$value = strVal(1);
$value = strInt("123");

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