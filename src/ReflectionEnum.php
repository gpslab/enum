<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

use GpsLab\Component\Enum\Exception\OutOfEnumException;

abstract class ReflectionEnum implements Enum, \Serializable
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
     * @var array
     */
    private static $constants = [];

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
    final public static function byValue($value)
    {
        $class = get_called_class();
        self::constants();

        $constant = array_search($value, self::$constants[$class], true);

        if ($constant === false) {
            throw OutOfEnumException::invalidValue($value, $class);
        }

        // limitation of count object instances
        if (!isset(self::$instances[$class][$constant])) {
            self::$instances[$class][$constant] = new static($value);
        }

        return self::$instances[$class][$constant];
    }

    /**
     * @param string $name
     *
     * @return Enum
     */
    final public static function byName($name)
    {
        $class = get_called_class();
        if (isset(self::$instances[$class][$name])) {
            return self::$instances[$class][$name];
        }

        self::constants();

        if (!isset(self::$constants[$class][$name])) {
            throw OutOfEnumException::undefinedConstant($class.'::'.$name);
        }

        return self::$instances[$class][$name] = new static(self::$constants[$class][$name]);
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
        foreach (self::constants() as $constant => $value) {
            $values[$constant] = self::byValue($value);
        }

        return $values;
    }

    /**
     * @return string
     */
    final public function name()
    {
        return array_search($this->value(), self::constants());
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
    final public static function choices()
    {
        $choices = [];
        foreach (self::constants() as $value) {
            $choices[$value] = (string) self::byValue($value);
        }

        return $choices;
    }

    /**
     * Return readable value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name();
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
        return serialize($this->value);
    }

    /**
     * @param mixed $data
     */
    public function unserialize($data)
    {
        self::byValue($this->value = unserialize($data));
    }

    /**
     * @return array
     */
    private static function constants()
    {
        $class = get_called_class();
        if (!isset(self::$constants[$class])) {
            self::$constants[$class] = ConstantDetector::detect($class);
        }

        return self::$constants[$class];
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Enum
     */
    public static function __callStatic($method, array $arguments = [])
    {
        return self::byName($method);
    }
}
