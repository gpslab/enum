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

class ConstAccess extends Set
{
    private const OPTION_PUT = 'put';
    public const ACTION_GET = 'get';
    protected const OPTION_DELETE = 'delete';
    public const ACTION_POST = 'post';

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function readable($value)
    {
        return 'acme.demo.const_access.'.strtolower(parent::readable($value));
    }
}
