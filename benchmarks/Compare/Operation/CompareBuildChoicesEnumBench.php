<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Compare\Operation;

use GpsLab\Component\Enum\Bench\Compare\CompareEnumBench;
use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp;
use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;
use GpsLab\Component\Enum\Tests\Fixture\Enum\DefRef;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcHappyTypes;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMyClabs;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\DefMarcMabe;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(2500)
 * @Iterations(25)
 */
class CompareBuildChoicesEnumBench implements CompareEnumBench
{
    public function benchReflectionEnum()
    {
        AbcRef::choices();
    }

    public function benchReflectionEnumNoMagic()
    {
        DefRef::choices();
    }

    public function benchExplicitEnum()
    {
        AbcExp::choices();
    }

    public function benchMyCLabsEnum()
    {
        AbcMyClabs::choices();
    }

    public function benchMabeEnum()
    {
        AbcMarcMabe::choices();
    }

    public function benchMabeNoMagicEnum()
    {
        DefMarcMabe::choices();
    }

    public function benchHappyTypesEnum()
    {
        AbcHappyTypes::choices();
    }
}
