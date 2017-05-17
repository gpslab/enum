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

/**
 * @method static DemoExp create($value)
 */
class DemoExp extends ExplicitEnum
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
            self::A => 'acme.demo.a',
            self::B => 'acme.demo.b',
            self::C => 'acme.demo.c',
        ];
    }
}
