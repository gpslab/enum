<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

use GpsLab\Component\Enum\Tests\Fixture\Set\AbcRef;

function test_gl()
{
    $a = new AbcRef();
    $a->attach(AbcRef::A);
    $a->attach(AbcRef::B);
    $a->attach(AbcRef::C);
    $a->values();

    AbcRef::choices();
}

function clear_gl()
{
    reset_class('GpsLab\Component\Enum\Set', ['bits', 'keys']);
}
