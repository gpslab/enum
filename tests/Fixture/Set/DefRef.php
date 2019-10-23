<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
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
