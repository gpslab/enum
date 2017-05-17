<?php
require 'bootstrap.php';

use GpsLab\Component\Enum\Tests\Enum\AbcRef;
use GpsLab\Component\Enum\Tests\Enum\AbcExp;
use GpsLab\Component\Enum\Tests\Enum\DefRef;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Input\ArgvInput;

$sw = new Stopwatch();
$input = new ArgvInput();
$N = $input->getFirstArgument();


$sw->start('ref', 'Reflection enum');
for ($i=0; $i<$N; $i++) {
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


$sw->start('nmag', 'Reflection enum no magic');
for ($i=0; $i<$N; $i++) {
    $d = DefRef::create(DefRef::D);
    $d->equals(DefRef::create(DefRef::D));

    $e = DefRef::create(DefRef::E);
    $e->equals(DefRef::create(DefRef::D));

    $f = DefRef::create(DefRef::F);
    $z = (string) $f;

    DefRef::choices();
    DefRef::values();
}
echo $sw->stop('nmag').PHP_EOL;


$sw->start('exp', 'Explicit enum');
for ($i=0; $i<$N; $i++) {
    $a = AbcExp::create(AbcExp::A);
    $a->equals(AbcExp::create(AbcExp::A));

    $b = AbcExp::create(AbcExp::B);
    $b->equals(AbcExp::create(AbcExp::A));

    $c = AbcExp::create(AbcExp::C);
    $e = (string) $c;

    AbcExp::choices();
    AbcExp::values();
}
echo $sw->stop('exp').PHP_EOL;
