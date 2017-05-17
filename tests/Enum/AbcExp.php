<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\ExplicitEnum;

class AbcExp extends ExplicitEnum
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @return array
     */
    public static function choices()
    {
        return [
            self::A => 'acme.demo.abc.a',
            self::B => 'acme.demo.abc.b',
            self::C => 'acme.demo.abc.c',
        ];
    }
}
