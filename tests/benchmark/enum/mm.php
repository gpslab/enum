<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

//require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;

function test_mm()
{
    $a = AbcMarcMabe::A();
    $a->is(AbcMarcMabe::A());

    $b = AbcMarcMabe::B();
    $b->is(AbcMarcMabe::A());

    $c = AbcMarcMabe::C();
    $z = (string)$c;

    AbcMarcMabe::choices();
    AbcMarcMabe::values();
}
