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
class CompareDifferentEnumBench implements CompareEnumBench
{
    public function benchReflectionEnum()
    {
        AbcRef::A()->equals(AbcRef::B());
    }

    public function benchReflectionEnumNoMagic()
    {
        DefRef::byValue(DefRef::D)->equals(DefRef::byValue(DefRef::E));
    }

    public function benchExplicitEnum()
    {
        AbcExp::byValue(AbcExp::A)->equals(AbcExp::byValue(AbcExp::B));
    }

    public function benchMyCLabsEnum()
    {
        AbcMyClabs::A()->equals(AbcMyClabs::B());
    }

    public function benchMabeEnum()
    {
        AbcMarcMabe::A()->is(AbcMarcMabe::B());
    }

    public function benchMabeNoMagicEnum()
    {
        DefMarcMabe::byValue(DefMarcMabe::D)->is(DefMarcMabe::byValue(DefMarcMabe::E));
    }

    public function benchHappyTypesEnum()
    {
        AbcHappyTypes::A()->equals(AbcHappyTypes::B());
    }
}
