<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class MabeEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $a = AbcMarcMabe::A();
    }

    public function benchCompareSelf()
    {
        $a = AbcMarcMabe::A();
        $a->is(AbcMarcMabe::A());
    }

    public function benchInitTwice()
    {
        $a = AbcMarcMabe::A();
        $z = AbcMarcMabe::A();
    }

    public function benchInitTwiceDifferentValue()
    {
        $a = AbcMarcMabe::A();
        $b = AbcMarcMabe::B();
    }

    public function benchCompareDifferent()
    {
        AbcMarcMabe::A()->is(AbcMarcMabe::B());
    }

    public function benchToString()
    {
        $c = (string) AbcMarcMabe::C();
    }

    public function benchBuildChoices()
    {
        AbcMarcMabe::choices();
    }

    public function benchBuildValues()
    {
        AbcMarcMabe::values();
    }
}
