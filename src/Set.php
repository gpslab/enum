<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

use GpsLab\Component\Enum\Exception\InvalidSetException;
use GpsLab\Component\Enum\Exception\OutOfEnumException;

class Set
{
    /**
     * @var int
     */
    private $bit = 0;

    /**
     * @var mixed[][]
     */
    private static $bits = [];

    /**
     * @var mixed[][]
     */
    private static $keys = [];

    /**
     * @param array $values
     */
    final public function __construct(array $values = [])
    {
        foreach ($values as $value) {
            $this->attach($value);
        }
    }

    /**
     * @return mixed[]
     */
    final public function values()
    {
        if (!$this->bit) {
            return [];
        }

        $values = [];
        foreach (self::$bits[get_called_class()] as $bit => $value) {
            if ($this->bit & $bit) {
                $values[] = $value;
            }
        }

        return $values;
    }

    /**
     * Attach the given value.
     *
     * @param mixed $value
     */
    final public function attach($value)
    {
        self::validateValue($value);

        $this->bit |= $this->bit($value);
    }

    /**
     * Detach the given value.
     *
     * @param mixed $value
     */
    final public function detach($value)
    {
        self::validateValue($value);

        $this->bit ^= $this->bit($value);
    }

    /**
     * Given value was attached.
     *
     * @param mixed $value
     *
     * @return bool
     */
    final public function contains($value)
    {
        self::validateValue($value);

        return (bool) ($this->bit & $this->bit($value));
    }

    /**
     * Check if this Set is the same as other.
     *
     * @param Set $set
     *
     * @return bool
     */
    final public function equal(Set $set)
    {
        self::validateType($set);

        return $this->bit === $this->bit;
    }

    /**
     * Check if this Set is a subset of other.
     *
     * @param Set $set
     *
     * @return bool
     */
    final public function subset(Set $set)
    {
        self::validateType($set);

        return ($this->bit & $set->bit) === $this->bit;
    }

    /**
     * Check if this Set is a superset of other.
     *
     * @param Set $set
     *
     * @return bool
     */
    final public function superset(Set $set)
    {
        self::validateType($set);

        return ($this->bit | $set->bit) === $this->bit;
    }

    /**
     * Produce a new set with enum from both this and other (this | other).
     *
     * @param Set ...$set Other Set(s) of the same enum to produce the union
     *
     * @return Set
     */
    final public function union(Set $set)
    {
        $bit = $this->bit;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new static();
        $clone->bit = $bit;

        return $clone;
    }

    /**
     * Produce a new set with enum common to both this and other (this & other).
     *
     * @param Set ...$set Other Set(s) of the same enumeration to produce the union
     *
     * @return Set
     */
    final public function intersect(Set $set)
    {
        $bit = $this->bit;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit &= $set->bit;
        }

        $clone = new static();
        $clone->bit = $bit;

        return $clone;
    }

    /**
     * Produce a new set with enum in this but not in other (this - other).
     *
     * @param Set ...$set Other Set(s) of the same enumeration to produce the union
     *
     * @return Set
     */
    final public function diff(Set $set)
    {
        $bit = 0;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new static();
        $clone->bit = $this->bit & ~$bit;

        return $clone;
    }

    /**
     * Produce a new set with enum in either this and other but not in both (this ^ (other | other)).
     *
     * @param Set ...$set Other Set(s) of the same enumeration to produce the union
     *
     * @return Set
     */
    final public function symDiff(Set $set)
    {
        $bit = 0;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new static();
        $clone->bit = $this->bit ^ $bit;

        return $clone;
    }

    /**
     * Get choices for checkbox group.
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
        self::detectConstants($class);

        $choices = [];
        foreach (self::$keys[$class] as $value) {
            $choices[$value] = static::readable($value);
        }

        return $choices;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function readable($value)
    {
        self::validateValue($value);

        return array_search($value, self::$keys[get_called_class()]);
    }

    /**
     * @param mixed $value
     */
    private static function validateValue($value)
    {
        if (!in_array($value, self::bits(), true)) {
            throw OutOfEnumException::invalidValue($value, get_called_class());
        }
    }

    /**
     * @param object $object
     */
    private static function validateType($object)
    {
        $class = get_called_class();
        if ($class !== get_class($object)) {
            throw InvalidSetException::notInstanceOf($class, get_class($object));
        }
    }

    /**
     * @param string $class
     */
    private static function detectConstants($class)
    {
        if (!isset(self::$bits[$class])) {
            self::$keys[$class] = [];
            self::$bits[$class] = [];

            $bit = 1;
            foreach (ConstantDetector::detect($class) as $constant => $constant_value) {
                self::$keys[$class][$constant] = $constant_value;
                self::$bits[$class][$bit] = $constant_value;
                $bit += $bit;
            }
        }
    }

    /**
     * @param mixed $value
     *
     * @return int
     */
    private function bit($value)
    {
        return array_search($value, self::bits());
    }

    /**
     * @return array
     */
    private static function bits()
    {
        $class = get_called_class();
        self::detectConstants($class);

        return self::$bits[$class];
    }
}
