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
    public static function create($value)
    {
        self::detectConstants(static::class);

        $method = array_search($value, self::$create_methods[static::class], true);

        if ($method === false) {
            throw OutOfEnumException::create($value, static::class);
        }

        // limitation of count object instances
        if (!isset(self::$instances[static::class][$method])) {
            self::$instances[static::class][$method] = new static($value);
        }

        return self::$instances[static::class][$method];
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
        foreach (self::constants() as $constant => $value) {
            $values[$constant] = static::create($value);
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
        return $this === $enum || ($this->value() === $enum->value() && static::class == get_class($enum));
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
    public static function choices()
    {
        $choices = [];
        foreach (self::constants() as $value) {
            $choices[$value] = (string) static::create($value);
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
        return $this->value;
    }

    /**
     * @param mixed $data
     */
    public function unserialize($data)
    {
        static::create($this->value = $data);
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

            $constants = [];
            $reflection = new \ReflectionClass($class);

            if (PHP_VERSION_ID >= 70100) {
                // Since PHP-7.1 visibility modifiers are allowed for class constants
                // for enumerations we are only interested in public once.
                foreach ($reflection->getReflectionConstants() as $refl_constant) {
                    if ($refl_constant->isPublic()) {
                        $constants[$refl_constant->getName()] = $refl_constant->getValue();
                    }
                }
            } else {
                // In PHP < 7.1 all class constants were public by definition
                foreach ($reflection->getConstants() as $constant => $constant_value) {
                    $constants[$constant] = $constant_value;
                }
            }

            foreach ($constants as $constant => $constant_value) {
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
        self::detectConstants(static::class);

        return self::$constants[static::class];
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
        self::detectConstants(static::class);

        if (!isset(self::$is_methods[static::class][$method])) {
            throw BadMethodCallException::noMethod($method, static::class);
        }

        return $this->value === self::$is_methods[static::class][$method];
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Enum
     */
    public static function __callStatic($method, array $arguments = [])
    {
        if (isset(self::$instances[static::class][$method])) {
            return self::$instances[static::class][$method];
        }

        self::detectConstants(static::class);

        if (!isset(self::$create_methods[static::class][$method])) {
            throw BadMethodCallException::noStaticMethod($method, static::class);
        }

        return self::$instances[static::class][$method] = new static(self::$create_methods[static::class][$method]);
    }
}
