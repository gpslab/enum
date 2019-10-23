<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class ReflectionEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $a = AbcRef::A();
    }

    public function benchCompareSelf()
    {
        $a = AbcRef::A();
        $a->equals(AbcRef::A());
    }

    public function benchInitTwice()
    {
        $a = AbcRef::A();
        $z = AbcRef::A();
    }

    public function benchInitTwiceDifferentValue()
    {
        $a = AbcRef::A();
        $b = AbcRef::B();
    }

    public function benchCompareDifferent()
    {
        AbcRef::A()->equals(AbcRef::B());
    }

    public function benchToString()
    {
        $c = (string) AbcRef::C();
    }

    public function benchBuildChoices()
    {
        AbcRef::choices();
    }

    public function benchBuildValues()
    {
        AbcRef::values();
    }
}
