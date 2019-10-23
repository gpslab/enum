<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
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
