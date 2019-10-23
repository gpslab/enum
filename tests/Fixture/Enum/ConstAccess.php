<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum;

use GpsLab\Component\Enum\ReflectionEnum;

/**
 * @method static ConstAccess ACTION_GET()
 * @method static ConstAccess ACTION_POST()
 * @method static ConstAccess byValue($value)
 * @method static ConstAccess byName($name)
 */
class ConstAccess extends ReflectionEnum
{
    private const OPTION_PUT = 'put';

    public const ACTION_GET = 'get';

    protected const OPTION_DELETE = 'delete';

    public const ACTION_POST = 'post';

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.const_access.'.strtolower(parent::__toString());
    }
}
