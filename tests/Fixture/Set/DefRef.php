<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Set;

use GpsLab\Component\Enum\Set;

class DefRef extends Set
{
    const D = 4;
    const E = 5;
    const F = 6;

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function readable($value)
    {
        return 'acme.demo.def.'.strtolower(parent::readable($value));
    }
}
