<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;

function test_ref()
{
    $a = AbcRef::A();
    $a->equals(AbcRef::A());

    $b = AbcRef::B();
    $b->equals(AbcRef::A());

    $c = AbcRef::C();
    $z = (string) $c;

    AbcRef::choices();
    AbcRef::values();
}

function clear_ref()
{
    reset_class('GpsLab\Component\Enum\ReflectionEnum', ['instances', 'constants']);
}
