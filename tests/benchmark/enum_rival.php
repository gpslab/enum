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

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Input\ArgvInput;

$sw = new Stopwatch();
$input = new ArgvInput();
$N = $input->getFirstArgument();

$tests = [
    'ref' => 'Reflection enum',
    'nmag' => 'Reflection enum (no magic)',
    'exp' => 'Explicit enum',
    'mc' => 'myclabs/php-enum',
    'mm' => 'marc-mabe/php-enum',
    'mmnm' => 'marc-mabe/php-enum (no magic)',
    'ht' => 'happy-types/enumerable-type',
];

foreach ($tests as $test => $title) {
    $sw->start($test, $title);
    for ($iteration = 0; $iteration < $N; ++$iteration) {
        require __DIR__.sprintf('/enum/%s.php', $test);
    }
    echo $sw->stop($test).PHP_EOL;
}
