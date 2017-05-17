#!/usr/bin/env php
<?php
require 'bootstrap.php';

use GpsLab\Component\Enum\Tests\Enum\DemoRef;
use GpsLab\Component\Enum\Tests\Enum\DemoExp;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Input\ArgvInput;

$sw = new Stopwatch();
$input = new ArgvInput();
$N = $input->getFirstArgument();


$sw->start('ref', 'ReflectionEnum');
for ($i=0; $i<$N; $i++) {
    $a = DemoRef::a();
    $a->equals(DemoRef::a());

    $b = DemoRef::b();
    $b->equals(DemoRef::a());

    $c = DemoRef::c();
    $e = (string) $c;

    DemoRef::choices();

    unset($a, $b, $c, $e);
}
echo $sw->stop('ref');

echo PHP_EOL;


$sw->start('exp', 'ExplicitEnum');
for ($i=0; $i<$N; $i++) {
    $a = DemoExp::create(DemoExp::A);
    $a->equals(DemoExp::create(DemoExp::A));

    $b = DemoExp::create(DemoExp::B);
    $b->equals(DemoExp::create(DemoExp::A));

    $c = DemoExp::create(DemoExp::C);
    $e = (string) $c;

    DemoExp::choices();

    unset($a, $b, $c, $e);
}
echo $sw->stop('exp');
