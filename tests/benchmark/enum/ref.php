<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;

$a = AbcRef::a();
$a->isA();

$b = AbcRef::b();
$b->isA();

$c = AbcRef::c();
$z = (string) $c;

AbcRef::choices();
AbcRef::values();
