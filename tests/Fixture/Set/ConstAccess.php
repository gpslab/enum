<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
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
