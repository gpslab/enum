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
    'ref' => 'Reflection enum',
    'refnm' => 'Reflection enum (no magic)',
    'exp' => 'Explicit enum',
    'mc' => 'myclabs/php-enum',
    'mm' => 'marc-mabe/php-enum',
    'mmnm' => 'marc-mabe/php-enum (no magic)',
    'ht' => 'happy-types/enumerable-type',
];

$results = [];

$output->section('Enum benchmark');
$output->progressStart(count($tests));

foreach ($tests as $test => $title) {
    include __DIR__.'/enum/'.$test.'.php';
    $sw = new Stopwatch();

    $sw->start($test, $title);
    for ($i = 0; $i < $N; ++$i) {
        call_user_func('test_'.$test);

        // clear cached data
        $sw->stop($test);
        call_user_func('clear_'.$test);
        $sw->start($test);
    }
    $event = $sw->stop($test);

    // Stopwatch incorrect calculate memory usage
    $memory = memory_get_usage();
    call_user_func('test_'.$test);
    $memory = memory_get_usage() - $memory;

    // save result
    $results[] = [
        $event->getCategory(),
        sprintf('%.2F KiB', $memory / 1024),
        sprintf('%d ms', $event->getDuration()),
    ];
    $output->progressAdvance();
}

$output->progressFinish();
$output->table(['Test', 'Memory', 'Duration'], $results);
