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
    protected function __construct($value)
    {
        if (!static::isValid($value)) {
            throw OutOfEnumException::create($value, static::class);
        }

        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @return Enum
     */
    public static function create($value)
    {
        $key = static::class.'|'.$value;

        // limitation of count object instances
        if (!isset(self::$instances[$key])) {
            self::$instances[$key] = new static($value);
        }

        return self::$instances[$key];
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Available values.
     *
     * @return Enum[]
     */
    public static function values()
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
    public function equals(Enum $enum)
    {
        return $this->value() === $enum->value() && static::class == get_class($enum);
    }

    /**
     * Is value supported.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function isValid($value)
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
