[![Latest Stable Version](https://poser.pugx.org/sebastian/uuid/v)](https://packagist.org/packages/sebastian/uuid)
[![CI Status](https://github.com/sebastianbergmann/uuid/workflows/CI/badge.svg)](https://github.com/sebastianbergmann/uuid/actions)
[![codecov](https://codecov.io/gh/sebastianbergmann/uuid/branch/main/graph/badge.svg)](https://codecov.io/gh/sebastianbergmann/uuid)

# sebastian/uuid

This package provides a single function: `uuid()`. This function uses PHP's `random_bytes()` function to generate a string that contains a 16-byte number written in hexadecimal and divided into five groups of characters (8-4-4-4-12).

Strings generated using the `uuid()` function can be used as Universally Unique Identifiers (UUIDs) in certain contexts.  

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require sebastian/uuid
```

If you only need this library during development, for instance to run your project's test suite, then you should add it as a development-time dependency:

```
composer require --dev sebastian/uuid
```

## Usage

```php
<?php declare(strict_types=1);
use function SebastianBergmann\Uuid\uuid;

var_dump(uuid());
```
```
string(36) "67b14e2a-17a4-43f7-aba5-859f7fc07b69"
```
