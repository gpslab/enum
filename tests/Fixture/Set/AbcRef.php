<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Set;

use GpsLab\Component\Enum\Set;

class AbcRef extends Set
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function readable($value)
    {
        return 'acme.demo.abc.'.strtolower(parent::readable($value));
    }
}
