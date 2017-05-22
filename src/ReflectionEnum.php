<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

use GpsLab\Component\Enum\Exception\BadMethodCallException;
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
     * @var mixed[][]
     */
    private static $create_methods = [];

    /**
     * @var mixed[][]
     */
    private static $is_methods = [];

    /**
     * @var mixed[][]
     */
    private static $constants = [];

    /**
     * @var mixed[][]
     */
    private static $choices = [];

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
        self::detectConstants($class);

        $method = array_search($value, self::$create_methods[$class], true);

        if ($method === false) {
            throw OutOfEnumException::create($value, $class);
        }

        // limitation of count object instances
        if (!isset(self::$instances[$class][$method])) {
            self::$instances[$class][$method] = new static($value);
        }

        return self::$instances[$class][$method];
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
        return in_array($value, self::constants(), true);
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
        $class = get_called_class();

        if (!isset(self::$choices[$class])) {
            self::$choices[$class] = [];
            foreach (self::constants() as $value) {
                self::$choices[$class][$value] = (string)self::byValue($value);
            }
        }

        return self::$choices[$class];
    }

    /**
     * Return readable value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->constant();
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
     * @param string $class
     */
    private static function detectConstants($class)
    {
        if (!isset(self::$create_methods[$class])) {
            self::$create_methods[$class] = [];
            self::$is_methods[$class] = [];
            self::$constants[$class] = [];

            foreach (ConstantDetector::detect($class) as $constant => $constant_value) {
                self::$constants[$class][$constant] = $constant_value;

                // second parameter of ucwords() is not supported on HHVM
                $constant = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($constant))));

                self::$is_methods[$class]['is'.$constant] = $constant_value;
                self::$create_methods[$class][lcfirst($constant)] = $constant_value;
            }
        }
    }

    /**
     * @return array
     */
    private static function constants()
    {
        $class = get_called_class();
        self::detectConstants($class);

        return self::$constants[$class];
    }

    /**
     * @return string
     */
    private function constant()
    {
        return array_search($this->value(), self::constants());
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return bool
     */
    public function __call($method, array $arguments = [])
    {
        $class = get_called_class();
        self::detectConstants($class);

        if (!isset(self::$is_methods[$class][$method])) {
            throw BadMethodCallException::noMethod($method, $class);
        }

        return $this->value === self::$is_methods[$class][$method];
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Enum
     */
    public static function __callStatic($method, array $arguments = [])
    {
        $class = get_called_class();
        if (isset(self::$instances[$class][$method])) {
            return self::$instances[$class][$method];
        }

        self::detectConstants($class);

        if (!isset(self::$create_methods[$class][$method])) {
            throw BadMethodCallException::noStaticMethod($method, $class);
        }

        return self::$instances[$class][$method] = new static(self::$create_methods[$class][$method]);
    }
}
