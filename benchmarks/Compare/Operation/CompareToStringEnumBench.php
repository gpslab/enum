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
class CompareToStringEnumBench implements CompareEnumBench
{
    public function benchReflectionEnum()
    {
        $a = (string) AbcRef::A();
    }

    public function benchReflectionEnumNoMagic()
    {
        $d = (string) DefRef::byValue(DefRef::D);
    }

    public function benchExplicitEnum()
    {
        $a = (string) AbcExp::byValue(AbcExp::A);
    }

    public function benchMyCLabsEnum()
    {
        $a = (string) AbcMyClabs::A();
    }

    public function benchMabeEnum()
    {
        $a = (string) AbcMarcMabe::A();
    }

    public function benchMabeNoMagicEnum()
    {
        $d = (string) DefMarcMabe::byValue(DefMarcMabe::D);
    }

    public function benchHappyTypesEnum()
    {
        $a = (string) AbcHappyTypes::A();
    }
}
