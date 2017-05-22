<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Enum;

/**
 * @method static ColorBW black()
 * @method static ColorBW white()
 * @method static ColorBW red()
 * @method static ColorBW green()
 * @method static ColorBW blue()
 * @method bool isBlack()
 * @method bool isWhite()
 * @method static ColorBW byValue($value)
 */
class ColorBW extends ColorRGB
{
    public const BLACK = 4;
    private const WHITE = 5;
}
