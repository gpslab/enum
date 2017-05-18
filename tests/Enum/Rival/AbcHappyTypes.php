<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Enum\Rival;

use HappyTypes\EnumerableType;

class AbcHappyTypes extends EnumerableType
{
    /**
     * @return self
     */
    final public static function A()
    {
        return static::get(1, 'A');
    }

    /**
     * @return self
     */
    final public static function B()
    {
        return static::get(2, 'B');
    }

    /**
     * @return self
     */
    final public static function C()
    {
        return static::get(3, 'C');
    }

    /**
     * @param EnumerableType $enum
     *
     * @return bool
     */
    public function equals(EnumerableType $enum)
    {
        return $this === $enum || ($this->id() === $enum->id() && get_called_class() == get_class($enum));
    }

    /**
     * @return EnumerableType[]
     */
    public static function values()
    {
        $values = [];
        foreach (static::enum() as $enum) {
            $values[$enum->name()] = $enum;
        }

        return $values;
    }

    /**
     * @return array
     */
    public static function choices()
    {
        $choices = [];
        foreach (static::values() as $value) {
            $choices[$value->id()] = (string) $value;
        }

        return $choices;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.abc.'.strtolower($this->name());
    }
}
