#!/usr/bin/env php
<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
require __DIR__.'/../bootstrap.php';

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcHappyTypes;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMyClabs;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;
use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;
use GpsLab\Component\Enum\Tests\Fixture\Enum\DefRef;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Input\ArgvInput;

$sw = new Stopwatch();
$input = new ArgvInput();
$N = $input->getFirstArgument();

// Reflection
$sw->start('ref', 'Reflection enum');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcRef::a();
    $a->isA();

    $b = AbcRef::b();
    $b->isA();

    $c = AbcRef::c();
    $z = (string) $c;

    AbcRef::choices();
    AbcRef::values();
}
echo $sw->stop('ref').PHP_EOL;

// Reflection (no magic)
$sw->start('nmag', 'Reflection enum no magic');
for ($i = 0; $i < $N; ++$i) {
    $d = DefRef::byValue(DefRef::D);
    $d->equals(DefRef::byValue(DefRef::D));

    $e = DefRef::byValue(DefRef::E);
    $e->equals(DefRef::byValue(DefRef::D));

    $f = DefRef::byValue(DefRef::F);
    $z = (string) $f;

    DefRef::choices();
    DefRef::values();
}
echo $sw->stop('nmag').PHP_EOL;

// myclabs/php-enum
$sw->start('mc', 'MyClabs enum');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcMyClabs::A();
    $a->equals(AbcMyClabs::A());

    $b = AbcMyClabs::B();
    $b->equals(AbcMyClabs::A());

    $c = AbcMyClabs::C();
    $z = (string) $c;

    AbcMyClabs::choices();
    AbcMyClabs::values();
}
echo $sw->stop('mc').PHP_EOL;

// marc-mabe/php-enum
$sw->start('mm', 'MarcMabe enum');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcMarcMabe::A();
    $a->is(AbcMarcMabe::A());

    $b = AbcMarcMabe::B();
    $b->is(AbcMarcMabe::A());

    $c = AbcMarcMabe::C();
    $z = (string) $c;

    AbcMarcMabe::choices();
    AbcMarcMabe::values();
}
echo $sw->stop('mm').PHP_EOL;

// marc-mabe/php-enum (no magic)
$sw->start('mmnm', 'MarcMabe enum no magic');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcMarcMabe::byValue(AbcMarcMabe::A);
    $a->is(AbcMarcMabe::byValue(AbcMarcMabe::A));

    $b = AbcMarcMabe::byValue(AbcMarcMabe::B);
    $b->is(AbcMarcMabe::byValue(AbcMarcMabe::A));

    $c = AbcMarcMabe::byValue(AbcMarcMabe::C);
    $z = (string) $c;

    AbcMarcMabe::choices();
    AbcMarcMabe::values();
}
echo $sw->stop('mmnm').PHP_EOL;

// happy-types/enumerable-type
$sw->start('ht', 'HappyTypes enum');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcHappyTypes::A();
    $a->equals(AbcHappyTypes::A());

    $b = AbcHappyTypes::B();
    $b->equals(AbcHappyTypes::A());

    $c = AbcHappyTypes::C();
    $z = (string) $c;

    AbcHappyTypes::choices();
    AbcHappyTypes::values();
}
echo $sw->stop('ht').PHP_EOL;

// Explicit
$sw->start('exp', 'Explicit enum');
for ($i = 0; $i < $N; ++$i) {
    $a = AbcExp::byValue(AbcExp::A);
    $a->equals(AbcExp::byValue(AbcExp::A));

    $b = AbcExp::byValue(AbcExp::B);
    $b->equals(AbcExp::byValue(AbcExp::A));

    $c = AbcExp::byValue(AbcExp::C);
    $e = (string) $c;

    AbcExp::choices();
    AbcExp::values();
}
echo $sw->stop('exp').PHP_EOL;
