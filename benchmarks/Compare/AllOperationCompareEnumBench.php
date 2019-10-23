<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Compare;

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
class AllOperationCompareEnumBench implements CompareEnumBench
{
    public function benchReflectionEnum()
    {
        $a = AbcRef::A();
        $a->equals(AbcRef::A());

        $b = AbcRef::B();
        $b->equals(AbcRef::A());

        $c = AbcRef::C();
        $z = (string) $c;

        AbcRef::choices();
        AbcRef::values();
    }

    public function benchReflectionEnumNoMagic()
    {
        $d = DefRef::byValue(DefRef::D);
        $d->equals(DefRef::byValue(DefRef::D));

        $e = DefRef::byValue(DefRef::E);
        $e->equals(DefRef::byValue(DefRef::D));

        $f = DefRef::byValue(DefRef::F);
        $z = (string) $f;

        DefRef::choices();
        DefRef::values();
    }

    public function benchExplicitEnum()
    {
        $a = AbcExp::byValue(AbcExp::A);
        $a->equals(AbcExp::byValue(AbcExp::A));

        $b = AbcExp::byValue(AbcExp::B);
        $b->equals(AbcExp::byValue(AbcExp::A));

        $c = AbcExp::byValue(AbcExp::C);
        $e = (string) $c;

        AbcExp::choices();
        AbcExp::values();
    }

    public function benchMyCLabsEnum()
    {
        $a = AbcMyClabs::A();
        $a->equals(AbcMyClabs::A());

        $b = AbcMyClabs::B();
        $b->equals(AbcMyClabs::A());

        $c = AbcMyClabs::C();
        $z = (string) $c;

        AbcMyClabs::choices();
        AbcMyClabs::values();
    }

    public function benchMabeEnum()
    {
        $a = AbcMarcMabe::A();
        $a->is(AbcMarcMabe::A());

        $b = AbcMarcMabe::B();
        $b->is(AbcMarcMabe::A());

        $c = AbcMarcMabe::C();
        $z = (string) $c;

        AbcMarcMabe::choices();
        AbcMarcMabe::values();
    }

    public function benchMabeNoMagicEnum()
    {
        $d = DefMarcMabe::byValue(DefMarcMabe::D);
        $d->is(DefMarcMabe::byValue(DefMarcMabe::D));

        $e = DefMarcMabe::byValue(DefMarcMabe::E);
        $e->is(DefMarcMabe::byValue(DefMarcMabe::D));

        $f = DefMarcMabe::byValue(DefMarcMabe::F);
        $z = (string) $f;

        DefMarcMabe::choices();
        DefMarcMabe::values();
    }

    public function benchHappyTypesEnum()
    {
        $a = AbcHappyTypes::A();
        $a->equals(AbcHappyTypes::A());

        $b = AbcHappyTypes::B();
        $b->equals(AbcHappyTypes::A());

        $c = AbcHappyTypes::C();
        $z = (string) $c;

        AbcHappyTypes::choices();
        AbcHappyTypes::values();
    }
}
