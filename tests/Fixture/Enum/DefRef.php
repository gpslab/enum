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
 * @method static DefRef D()
 * @method static DefRef E()
 * @method static DefRef F()
 * @method static DefRef byValue($value)
 * @method static DefRef byName($name)
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
