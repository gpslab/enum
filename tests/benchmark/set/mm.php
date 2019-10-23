<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
use MabeEnum\EnumSet;
use GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe;

function test_mm()
{
    $a = new EnumSet('GpsLab\Component\Enum\Tests\Fixture\Enum\Rival\AbcMarcMabe');
    $a->attach(AbcMarcMabe::A);
    $a->attach(AbcMarcMabe::B);
    $a->attach(AbcMarcMabe::C);
    $a->getValues();

    AbcMarcMabe::choices();
}

function clear_mm()
{
    reset_class('MabeEnum\Enum', ['constants', 'instances']);
}
