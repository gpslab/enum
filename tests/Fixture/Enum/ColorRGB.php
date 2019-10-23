<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum;

use GpsLab\Component\Enum\ReflectionEnum;

/**
 * @method static ColorRGB RED()
 * @method static ColorRGB GREEN()
 * @method static ColorRGB BLUE()
 * @method static ColorRGB byValue($value)
 * @method static ColorRGB byName($name)
 */
class ColorRGB extends ReflectionEnum
{
    const RED = 1;

    const GREEN = 2;

    const BLUE = 3;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.color.'.strtolower(parent::__toString());
    }
}
