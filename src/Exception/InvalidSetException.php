<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Exception;

class InvalidSetException extends \InvalidArgumentException
{
    /**
     * @param string $expected
     * @param string $actual
     *
     * @return self
     */
    public static function notInstanceOf($expected, $actual)
    {
        return new self(sprintf(
            'Set should be an instance of "%s" of the same enum as this "%s".',
            $expected,
            $actual
        ));
    }
}
