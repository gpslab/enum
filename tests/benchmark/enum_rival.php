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
    'refnm' => 'Reflection enum (no magic)',
    'exp' => 'Explicit enum',
    'mc' => 'myclabs/php-enum',
    'mm' => 'marc-mabe/php-enum',
    'mmnm' => 'marc-mabe/php-enum (no magic)',
    'ht' => 'happy-types/enumerable-type',
];

// get title max length
$length = 0;
foreach ($tests as $test => $title) {
    $length = max($length, strlen($title));
    include __DIR__.'/enum/'.$test.'.php';
}


foreach ($tests as $test => $title) {
    $sw->start($test, str_pad($title, $length));
    for ($iteration = 0; $iteration < $N; ++$iteration) {
        call_user_func('test_'.$test);
    }
    echo $sw->stop($test).PHP_EOL;
}
