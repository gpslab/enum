<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;

function test_ref()
{
    $a = AbcRef::a();
    $a->isA();

    $b = AbcRef::b();
    $b->isA();

    $c = AbcRef::c();
    $z = (string) $c;

    AbcRef::choices();
    AbcRef::values();
}

function clear_ref()
{
    reset_class('GpsLab\Component\Enum\ReflectionEnum', [
        'instances',
        'create_methods',
        'is_methods',
        'constants',
    ]);
}
