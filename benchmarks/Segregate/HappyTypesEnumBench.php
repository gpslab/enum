<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcHappyTypes;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class HappyTypesEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $a = AbcHappyTypes::A();
    }

    public function benchCompareSelf()
    {
        $a = AbcHappyTypes::A();
        $a->equals(AbcHappyTypes::A());
    }

    public function benchInitTwice()
    {
        $a = AbcHappyTypes::A();
        $z = AbcHappyTypes::A();
    }

    public function benchInitTwiceDifferentValue()
    {
        $a = AbcHappyTypes::A();
        $b = AbcHappyTypes::B();
    }

    public function benchCompareDifferent()
    {
        AbcHappyTypes::A()->equals(AbcHappyTypes::B());
    }

    public function benchToString()
    {
        $c = (string) AbcHappyTypes::C();
    }

    public function benchBuildChoices()
    {
        AbcHappyTypes::choices();
    }

    public function benchBuildValues()
    {
        AbcHappyTypes::values();
    }
}
