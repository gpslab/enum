<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class ExplicitEnumBench implements SegregateEnumBench
{
    public function benchInit()
    {
        $a = AbcExp::byValue(AbcExp::A);
    }

    public function benchCompareSelf()
    {
        $a = AbcExp::byValue(AbcExp::A);
        $a->equals(AbcExp::byValue(AbcExp::A));
    }

    public function benchInitTwice()
    {
        $a = AbcExp::byValue(AbcExp::A);
        $z = AbcExp::byValue(AbcExp::A);
    }

    public function benchInitTwiceDifferentValue()
    {
        $a = AbcExp::byValue(AbcExp::A);
        $b = AbcExp::byValue(AbcExp::B);
    }

    public function benchCompareDifferent()
    {
        AbcExp::byValue(AbcExp::A)->equals(AbcExp::byValue(AbcExp::B));
    }

    public function benchToString()
    {
        $c = (string) AbcExp::byValue(AbcExp::C);
    }

    public function benchBuildChoices()
    {
        AbcExp::choices();
    }

    public function benchBuildValues()
    {
        AbcExp::values();
    }
}
