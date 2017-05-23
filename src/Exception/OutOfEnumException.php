<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Exception;

class OutOfEnumException extends \OutOfRangeException
{
    /**
     * @param string $value
     * @param string $type
     *
     * @return self
     */
    public static function invalidValue($value, $type)
    {
        return new self(sprintf('Value "%s" is not supported for "%s".', $value, $type));
    }

    /**
     * @param string $constant
     *
     * @return self
     */
    public static function undefinedConstant($constant)
    {
        return new self(sprintf('Constant "%s" is not defined.', $constant));
    }
}
