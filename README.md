<p align="center"><img src="/art/socialcard.png" alt="Social Card of Mastermind"></p>

# Mastermind game implementation

[![Latest Stable Version](https://poser.pugx.org/gabbanaesteban/mastermind/v)](//packagist.org/packages/gabbanaesteban/mastermind) [![Total Downloads](https://poser.pugx.org/gabbanaesteban/mastermind/downloads)](//packagist.org/packages/gabbanaesteban/mastermind) [![Latest Unstable Version](https://poser.pugx.org/gabbanaesteban/mastermind/v/unstable)](//packagist.org/packages/gabbanaesteban/mastermind) [![License](https://poser.pugx.org/gabbanaesteban/mastermind/license)](//packagist.org/packages/gabbanaesteban/mastermind)

This package is an implementation of the game Mastermind.

## Requirements

This package requires PHP 7.4 or higher.

## Installation

You can install the package via composer:

``` bash
composer require gabbanaesteban/mastermind
```

## Basic Usage

```php
require_once __DIR__ . '/vendor/autoload.php';

use Gabbanaesteban\Mastermind\Mastermind;
use Gabbanaesteban\Mastermind\Color;

$mastermind = Mastermind::withRandomCode();

//OR

$mastermind = new Mastermind([
    Color::YELLOW, Color::GREEN, Color::PINK, Color::YELLOW
]);

$mastermind->getHints([
    Color::BLUE, Color::BLUE, Color::YELLOW, Color::YELLOW
]); // ['white', 'black']
```

## Testing

You can run the tests with:

```bash
composer test
```

## Credits

- [Esteban De la Rosa](https://github.com/gabbanaesteban)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](/.github/LICENSE.md) for more information.