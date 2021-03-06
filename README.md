[![Latest Stable Version](https://img.shields.io/packagist/v/gpslab/enum.svg?maxAge=3600&label=stable)](https://packagist.org/packages/gpslab/enum)
[![Total Downloads](https://img.shields.io/packagist/dt/gpslab/enum.svg?maxAge=3600)](https://packagist.org/packages/gpslab/enum)
[![Build Status](https://img.shields.io/travis/gpslab/enum.svg?maxAge=3600)](https://travis-ci.org/gpslab/enum)
[![Coverage Status](https://img.shields.io/coveralls/gpslab/enum.svg?maxAge=3600)](https://coveralls.io/github/gpslab/enum?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/gpslab/enum.svg?maxAge=3600)](https://scrutinizer-ci.com/g/gpslab/enum/?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/535fd1c2-7b07-47e7-bcaa-702e081f31e8.svg?maxAge=3600&label=SLInsight)](https://insight.sensiolabs.com/projects/535fd1c2-7b07-47e7-bcaa-702e081f31e8)
[![StyleCI](https://styleci.io/repos/91466048/shield?branch=master)](https://styleci.io/repos/91466048)
[![License](https://img.shields.io/packagist/l/gpslab/enum.svg?maxAge=3600)](https://github.com/gpslab/enum)

# PHP enum

Simple and fast implementation of enumerations

## Introduction

### Definition

> In computer programming, an **enumerated type**
(also called **enumeration** or **enum**)
is a data type consisting of a set of named values called **elements**, members or enumerators of the type.
— [Wikipedia](http://en.wikipedia.org/wiki/Enumerated_type)

### SplEnum

[SplEnum](http://php.net/manual/en/class.splenum.php) is not integrated to PHP,
you have to install it separately:

`$ sudo pecl install SPL_Types`.

In addition, it's not a panacea:

```php
class Month extends SplEnum {
    const JANUARY  = 1;
    const FEBRUARY = 2;
}

class Fruit extends SplEnum {
    const APPLE  = 1;
    const ORANGE = 2;
}

// you must create new instance before each use:
$jan   = new Month(Month::JANUARY);
$jan2  = new Month(Month::JANUARY);
$apple = new Fruit(Fruit::APPLE);

var_dump($jan === $jan2);          // false
var_dump($jan === Month::JANUARY); // false
var_dump($jan ==  Fruit::APPLE);   // true
```

### Benchmark

Enum benchmark on PHP 7

```
$ tests/benchmark/enum.php 100000

 ------------------------------- ------------ --------------
  Test                            Memory Avg   Duration All
 ------------------------------- ------------ --------------
  Reflection enum                 1.52 KiB     1820 ms
  Reflection enum (no magic)      1.52 KiB     1718 ms
  Explicit enum                   0.71 KiB     959 ms
  myclabs/php-enum                0.68 KiB     1971 ms
  marc-mabe/php-enum              1.59 KiB     2219 ms
  marc-mabe/php-enum (no magic)   1.59 KiB     1969 ms
  happy-types/enumerable-type     1.81 KiB     2322 ms
 ------------------------------- ------------ --------------
```

Set benchmark on PHP 7

```
$ tests/benchmark/set.php 100000

 -------------------- ------------ --------------
  Test                 Memory Avg   Duration All
 -------------------- ------------ --------------
  Reflection set       1.36 KiB     1238 ms
  marc-mabe/php-enum   1.59 KiB     2861 ms
 -------------------- ------------ --------------
```

### How to get enum with default value?

```php
final class Color extends ReflectionEnum implements EnumDefault
{
    const RED = 1;
    const GREEN = 2;
    const BLUE = 3;

    /**
     * @return Color
     */
    public static function byDefault()
    {
        return self::byValue(self::RED);
    }
}
```
