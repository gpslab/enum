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
 * @method static DemoRef a()
 * @method static DemoRef b()
 * @method static DemoRef c()
 * @method bool isA()
 * @method bool isB()
 * @method bool isC()
 * @method static DemoRef create($value)
 */
class DemoRef extends ReflectionEnum
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.'.strtolower(parent::__toString());
    }
}
