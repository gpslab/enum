<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum;

interface EnumDefault extends Enum
{
    /**
     * @return EnumDefault
     */
    public static function byDefault();
}
