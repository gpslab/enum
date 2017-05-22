<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\ReflectionEnum;

/**
 * @method static DefRef a()
 * @method static DefRef b()
 * @method static DefRef c()
 * @method bool isA()
 * @method bool isB()
 * @method bool isC()
 * @method static DefRef byValue($value)
 */
class DefRef extends ReflectionEnum
{
    const D = 4;
    const E = 5;
    const F = 6;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.def.'.strtolower(parent::__toString());
    }
}
