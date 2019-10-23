<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
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
