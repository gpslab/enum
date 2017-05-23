<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

//require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\DefMarcMabe;

function test_mmnm()
{
    $d = DefMarcMabe::byValue(DefMarcMabe::D);
    $d->is(DefMarcMabe::byValue(DefMarcMabe::D));

    $e = DefMarcMabe::byValue(DefMarcMabe::E);
    $e->is(DefMarcMabe::byValue(DefMarcMabe::D));

    $f = DefMarcMabe::byValue(DefMarcMabe::F);
    $z = (string)$f;

    DefMarcMabe::choices();
    DefMarcMabe::values();
}
