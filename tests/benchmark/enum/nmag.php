<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

require __DIR__.'/../../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\DefRef;

$d = DefRef::byValue(DefRef::D);
$d->equals(DefRef::byValue(DefRef::D));

$e = DefRef::byValue(DefRef::E);
$e->equals(DefRef::byValue(DefRef::D));

$f = DefRef::byValue(DefRef::F);
$z = (string) $f;

DefRef::choices();
DefRef::values();
