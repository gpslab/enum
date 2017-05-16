<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Exception;

class BadMethodCallException extends \BadMethodCallException
{
    /**
     * @param string $method
     * @param string $class
     *
     * @return self
     */
    public static function noStaticMethod($method, $class)
    {
        return new self(sprintf('No static method "%s" in class "%s".', $method, $class));
    }

    /**
     * @param string $method
     * @param string $class
     *
     * @return self
     */
    public static function noMethod($method, $class)
    {
        return new self(sprintf('No method "%s" in class "%s".', $method, $class));
    }
}
