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
class CompareInitTwiceDifferentValueEnumBench implements CompareEnumBench
{
    public function benchReflectionEnum()
    {
        $a = AbcRef::A();
        $b = AbcRef::B();
    }

    public function benchReflectionEnumNoMagic()
    {
        $d = DefRef::byValue(DefRef::D);
        $e = DefRef::byValue(DefRef::E);
    }

    public function benchExplicitEnum()
    {
        $a = AbcExp::byValue(AbcExp::A);
        $b = AbcExp::byValue(AbcExp::B);
    }

    public function benchMyCLabsEnum()
    {
        $a = AbcMyClabs::A();
        $b = AbcMyClabs::B();
    }

    public function benchMabeEnum()
    {
        $a = AbcMarcMabe::A();
        $b = AbcMarcMabe::B();
    }

    public function benchMabeNoMagicEnum()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
        $e = DefMarcMabe::byValue(DefMarcMabe::E);
    }

    public function benchHappyTypesEnum()
    {
        $a = AbcHappyTypes::A();
        $b = AbcHappyTypes::B();
    }
}
