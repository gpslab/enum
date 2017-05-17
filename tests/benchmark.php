<?php
require 'bootstrap.php';

use GpsLab\Component\Enum\Tests\Enum\DemoRef;
use GpsLab\Component\Enum\Tests\Enum\DemoExp;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Input\ArgvInput;

$sw = new Stopwatch();
$input = new ArgvInput();
$N = $input->getFirstArgument();


$sw->start('ref', 'Reflection enum');
for ($i=0; $i<$N; $i++) {
    $a = DemoRef::a();
    $a->isA();

    $b = DemoRef::b();
    $b->isA();

    $c = DemoRef::c();
    $e = (string) $c;

    DemoRef::choices();
    DemoRef::values();
}
echo $sw->stop('ref').PHP_EOL;


$sw->start('nmag', 'Reflection enum no magic');
for ($i=0; $i<$N; $i++) {
    $a = DemoRef::create(DemoRef::A);
    $a->equals(DemoRef::create(DemoRef::A));

    $b = DemoRef::create(DemoRef::B);
    $b->equals(DemoRef::create(DemoRef::A));

    $c = DemoRef::create(DemoRef::C);
    $e = (string) $c;

    DemoRef::choices();
    DemoRef::values();
}
echo $sw->stop('nmag').PHP_EOL;


$sw->start('exp', 'Explicit enum');
for ($i=0; $i<$N; $i++) {
    $a = DemoExp::create(DemoExp::A);
    $a->equals(DemoExp::create(DemoExp::A));

    $b = DemoExp::create(DemoExp::B);
    $b->equals(DemoExp::create(DemoExp::A));

    $c = DemoExp::create(DemoExp::C);
    $e = (string) $c;

    DemoExp::choices();
    DemoExp::values();
}
echo $sw->stop('exp').PHP_EOL;
