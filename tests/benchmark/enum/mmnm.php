<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;

$a = AbcMarcMabe::byValue(AbcMarcMabe::A);
$a->is(AbcMarcMabe::byValue(AbcMarcMabe::A));

$b = AbcMarcMabe::byValue(AbcMarcMabe::B);
$b->is(AbcMarcMabe::byValue(AbcMarcMabe::A));

$c = AbcMarcMabe::byValue(AbcMarcMabe::C);
$z = (string) $c;

AbcMarcMabe::choices();
AbcMarcMabe::values();

