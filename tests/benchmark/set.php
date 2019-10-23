#!/usr/bin/env php
<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
require __DIR__.'/../bootstrap.php';

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

$input = new ArgvInput();
$output = new SymfonyStyle($input, new ConsoleOutput());
$N = $input->getFirstArgument();

function reset_class($class, $properties)
{
    $ref = new ReflectionClass($class);
    foreach ($properties as $property_name) {
        $property = $ref->getProperty($property_name);
        $property->setAccessible(true);
        $property->setValue([]);
    }
}

$tests = [
    'gl' => 'Reflection set',
    'mm' => 'marc-mabe/php-enum',
];

$results = [];

$output->section('Set benchmark');
$output->progressStart(count($tests));

foreach ($tests as $test => $title) {
    include __DIR__.'/set/'.$test.'.php';

    $sum_memory = 0;
    $sum_duration = 0;
    for ($i = 0; $i < $N; ++$i) {
        $memory = memory_get_usage();
        $duration = microtime(true);
        call_user_func('test_'.$test); // run test
        $sum_duration += microtime(true) - $duration;
        $sum_memory += memory_get_usage() - $memory;

        // clear cached data
        call_user_func('clear_'.$test);
    }

    $results[] = [
        $title,
        sprintf('%.2F KiB', $sum_memory / $N / 1024),
        sprintf('%d ms', round($sum_duration * 1000)),
    ];
    $output->progressAdvance();
}

$output->progressFinish();
$output->table(['Test', 'Memory Avg', 'Duration All'], $results);
