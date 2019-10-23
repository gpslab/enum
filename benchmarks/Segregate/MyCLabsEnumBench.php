<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMyClabs;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class MyCLabsEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $a = AbcMyClabs::A();
    }

    public function benchCompareSelf()
    {
        $a = AbcMyClabs::A();
        $a->equals(AbcMyClabs::A());
    }

    public function benchInitTwice()
    {
        $a = AbcMyClabs::A();
        $z = AbcMyClabs::A();
    }

    public function benchInitTwiceDifferentValue()
    {
        $a = AbcMyClabs::A();
        $b = AbcMyClabs::B();
    }

    public function benchCompareDifferent()
    {
        AbcMyClabs::A()->equals(AbcMyClabs::B());
    }

    public function benchToString()
    {
        $c = (string) AbcMyClabs::C();
    }

    public function benchBuildChoices()
    {
        AbcMyClabs::choices();
    }

    public function benchBuildValues()
    {
        AbcMyClabs::values();
    }
}
