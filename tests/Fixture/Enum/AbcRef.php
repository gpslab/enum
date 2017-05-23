<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum;

use GpsLab\Component\Enum\ReflectionEnum;

/**
 * @method static AbcRef A()
 * @method static AbcRef B()
 * @method static AbcRef C()
 * @method static AbcRef byValue($value)
 */
class AbcRef extends ReflectionEnum
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.abc.'.strtolower(parent::__toString());
    }
}
