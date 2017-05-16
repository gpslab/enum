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
    private static $keys = [];

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
     * @return mixed[]
     */
    public static function values()
    {
        return array_values(static::createMethods());
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
        return in_array($value, static::createMethods(), true);
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
        foreach (static::values() as $value) {
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
        return $this->key();
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

    private static function detectConstants()
    {
        if (!isset(self::$create_methods[static::class])) {
            self::$create_methods[static::class] = [];
            self::$is_methods[static::class] = [];
            self::$keys[static::class] = [];

            $constants = [];
            $reflection = new \ReflectionClass(static::class);

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
                self::$keys[static::class][$constant] = $constant_value;

                $constant = str_replace('_', '', ucwords(strtolower($constant), '_'));

                self::$is_methods[static::class]['is'.$constant] = $constant_value;
                self::$create_methods[static::class][lcfirst($constant)] = $constant_value;
            }
        }
    }

    /**
     * @return array
     */
    private static function createMethods()
    {
        static::detectConstants();

        return self::$create_methods[static::class];
    }

    /**
     * @return array
     */
    private static function isMethods()
    {
        static::detectConstants();

        return self::$is_methods[static::class];
    }

    /**
     * @return string
     */
    private function key()
    {
        static::detectConstants();

        return array_search($this->value(), self::$keys[static::class]);
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return bool
     */
    public function __call($method, array $arguments = [])
    {
        if (!isset(static::isMethods()[$method])) {
            throw BadMethodCallException::noMethod($method, static::class);
        }

        return $this->value === static::isMethods()[$method];
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Enum
     */
    public static function __callStatic($method, array $arguments = [])
    {
        if (!isset(static::createMethods()[$method])) {
            throw BadMethodCallException::noStaticMethod($method, static::class);
        }

        return static::create(static::createMethods()[$method]);
    }
}
