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
