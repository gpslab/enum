<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

use GpsLab\Component\Enum\Exception\OutOfEnumException;

abstract class ExplicitEnum implements Enum, \Serializable
{
    /**
     * @var mixed
     */
    private $value = '';

    /**
     * @var Enum[]
     */
    private static $instances = [];

    /**
     * @param mixed $value
     */
    final private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @return Enum
     */
    final public static function create($value)
    {
        $key = get_called_class().'|'.$value;

        // limitation of count object instances
        if (!isset(self::$instances[$key])) {
            if (!static::isValid($value)) {
                throw OutOfEnumException::create($value, get_called_class());
            }

            self::$instances[$key] = new static($value);
        }

        return self::$instances[$key];
    }

    /**
     * @return mixed
     */
    final public function value()
    {
        return $this->value;
    }

    /**
     * Available values.
     *
     * @return Enum[]
     */
    final public static function values()
    {
        $values = [];
        foreach (static::choices() as $value => $label) {
            $values[$label] = $value;
        }

        return $values;
    }

    /**
     * @param Enum $enum
     *
     * @return bool
     */
    final public function equals(Enum $enum)
    {
        return $this === $enum || ($this->value() === $enum->value() && get_called_class() == get_class($enum));
    }

    /**
     * Is value supported.
     *
     * @param mixed $value
     *
     * @return bool
     */
    final public static function isValid($value)
    {
        return array_key_exists($value, static::choices());
    }

    /**
     * Return readable value.
     *
     * @return string
     */
    public function __toString()
    {
        return static::choices()[$this->value()];
    }

    final public function __clone()
    {
        throw new \LogicException('Enumerations are not cloneable');
    }

    /**
     * @return mixed
     */
    public function serialize()
    {
        return $this->value;
    }

    /**
     * @param mixed $data
     */
    public function unserialize($data)
    {
        static::create($this->value = $data);
    }
}
