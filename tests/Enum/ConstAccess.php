<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\ReflectionEnum;

/**
 * @method static ConstAccess actionGet()
 * @method static ConstAccess actionPost()
 * @method bool isActionGet()
 * @method bool isActionPost()
 * @method static ConstAccess byValue($value)
 */
class ConstAccess extends ReflectionEnum
{
    public const ACTION_GET = 'get';
    public const ACTION_POST = 'post';
    protected const OPTION_DELETE = 'delete';
    private const OPTION_PUT = 'put';

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.const_access.'.strtolower(parent::__toString());
    }
}
