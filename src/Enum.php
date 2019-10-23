<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

interface Enum
{
    /**
     * @param mixed $value
     *
     * @return self
     */
    public static function byValue($value);

    /**
     * @return mixed
     */
    public function value();

    /**
     * Available values.
     *
     * @return mixed[]
     */
    public static function values();

    /**
     * @param self $enum
     *
     * @return bool
     */
    public function equals(self $enum);

    /**
     * Get choices for radio group.
     *
     * <code>
     * {
     *   value1: 'Readable value 1',
     *   value2: 'Readable value 2',
     * }
     * </code>
     *
     * @return array
     */
    public static function choices();

    /**
     * Return readable value.
     *
     * @return string
     */
    public function __toString();
}
