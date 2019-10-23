<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum;

/**
 * @method static ColorBW BLACK()
 * @method static ColorBW WHITE()
 * @method static ColorBW RED()
 * @method static ColorBW GREEN()
 * @method static ColorBW BLUE()
 * @method static ColorBW byValue($value)
 * @method static ColorBW byName($name)
 */
class ColorBW extends ColorRGB
{
    const BLACK = 4;
    const WHITE = 5;
}
