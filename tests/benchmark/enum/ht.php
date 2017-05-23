<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcHappyTypes;

function test_ht()
{
    $a = AbcHappyTypes::A();
    $a->equals(AbcHappyTypes::A());

    $b = AbcHappyTypes::B();
    $b->equals(AbcHappyTypes::A());

    $c = AbcHappyTypes::C();
    $z = (string) $c;

    AbcHappyTypes::choices();
    AbcHappyTypes::values();
}

function clear_ht()
{
    reset_class('HappyTypes\EnumerableType', ['instances', 'enumCache']);
}
