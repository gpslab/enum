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
    public const ACTION_GET = 'get';
    public const ACTION_POST = 'post';
    protected const OPTION_DELETE = 'delete';
    private const OPTION_PUT = 'put';

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
