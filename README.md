# Enum
This package holds a simple class that may be used as an ancestor for your enum classes.

[![Build Status](https://travis-ci.com/Werkspot/Enum.svg?branch=master)](https://travis-ci.com/Werkspot/Enum)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Werkspot/Enum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/Enum/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Werkspot/Enum/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/Enum/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/werkspot/enum/v/stable)](https://packagist.org/packages/werkspot/enum)
[![License](https://poser.pugx.org/werkspot/enum/license)](https://packagist.org/packages/werkspot/enum)


### Install

`# composer require werkspot/enum`

### Usage

Extend the Werkspot\Enum\AbstractEnum, define your enum key values as constants.

```php
namespace YourAwesomeOrganisation\Project;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static FooEnum foo()
 * @method bool isFoo()
 * @method static FooEnum bar()
 * @method bool isBar()
 * @method static FooEnum baz()
 * @method bool isBaz()
 */
final class FooEnum extends AbstractEnum
{
    const FOO = 'foo';
    const BAR = 'bar';
    const BAZ = 'baz';   
}
```

Now you can use the enum in a class:

```php
namespace YourAwesomeOrganisation\Project;

final class Bar
{
    /** @var FooEnum */
    private $enum;
    
    punblic function __construct(FooEnum $enum)
    {
        $this->enum = $enum;
    }
    
    public function getEnum(): FooEnum
    {
        return $this->enum;    
    }
}
```
Implementation of that class

```php
$fooEnum = FooEnum::baz();
$bar = new Bar($fooEnum);

$enum = $bar->getEnum();
$value = $enum->getValue(); // will return 'baz'
```
