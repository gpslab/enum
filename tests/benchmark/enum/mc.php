<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

//require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMyClabs;

function test_mc()
{
    $a = AbcMyClabs::A();
    $a->equals(AbcMyClabs::A());

    $b = AbcMyClabs::B();
    $b->equals(AbcMyClabs::A());

    $c = AbcMyClabs::C();
    $z = (string)$c;

    AbcMyClabs::choices();
    AbcMyClabs::values();
}

function clear_mc()
{
    reset_class('GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMyClabs', ['choices']);
    reset_class('MyCLabs\Enum\Enum', ['cache']);
}
