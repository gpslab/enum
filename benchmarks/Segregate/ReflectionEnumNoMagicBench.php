<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\DefRef;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class ReflectionEnumNoMagicBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $d = DefRef::byValue(DefRef::D);
    }

    public function benchCompareSelf()
    {
        $d = DefRef::byValue(DefRef::D);
        $d->equals(DefRef::byValue(DefRef::D));
    }

    public function benchInitTwice()
    {
        $d = DefRef::byValue(DefRef::D);
        $z = DefRef::byValue(DefRef::D);
    }

    public function benchInitTwiceDifferentValue()
    {
        $d = DefRef::byValue(DefRef::D);
        $e = DefRef::byValue(DefRef::E);
    }

    public function benchCompareDifferent()
    {
        DefRef::byValue(DefRef::D)->equals(DefRef::byValue(DefRef::E));
    }

    public function benchToString()
    {
        $f = (string) DefRef::byValue(DefRef::F);
    }

    public function benchBuildChoices()
    {
        DefRef::choices();
    }

    public function benchBuildValues()
    {
        DefRef::values();
    }
}
