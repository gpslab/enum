<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\DefMarcMabe;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class MabeNoMagicEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
    }

    public function benchCompareSelf()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
        $d->is(DefMarcMabe::byValue(DefMarcMabe::D));
    }

    public function benchInitTwice()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
        $z = DefMarcMabe::byValue(DefMarcMabe::D);
    }

    public function benchInitTwiceDifferentValue()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
        $e = DefMarcMabe::byValue(DefMarcMabe::E);
    }

    public function benchCompareDifferent()
    {
        DefMarcMabe::byValue(DefMarcMabe::D)->is(DefMarcMabe::byValue(DefMarcMabe::E));
    }

    public function benchToString()
    {
        $f = (string) DefMarcMabe::F();
    }

    public function benchBuildChoices()
    {
        DefMarcMabe::choices();
    }

    public function benchBuildValues()
    {
        DefMarcMabe::values();
    }
}
