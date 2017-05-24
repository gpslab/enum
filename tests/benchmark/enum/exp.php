<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */
use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp;

function test_exp()
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

function clear_exp()
{
    reset_class('GpsLab\Component\Enum\ExplicitEnum', ['instances']);
}
