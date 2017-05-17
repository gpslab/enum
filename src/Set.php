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
    public function __construct(array $values = [])
    {
        foreach ($values as $value) {
            $this->attach($value);
        }
    }

    /**
     * @return mixed[]
     */
    public function values()
    {
        if (!$this->bit) {
            return [];
        }

        $values = [];
        foreach (self::$bits[static::class] as $bit => $value) {
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
    public function attach($value)
    {
        self::validateValue($value);

        $this->bit |= $this->bit($value);
    }

    /**
     * Detach the given value.
     *
     * @param mixed $value
     */
    public function detach($value)
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
    public function contains($value)
    {
        self::validateValue($value);

        return (bool) ($this->bit & $this->bit($value));
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
        return in_array($value, self::bits(), true);
    }

    /**
     * Check if this Set is the same as other.
     *
     * @param Set $set
     *
     * @return bool
     */
    public function equal(Set $set)
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
    public function subset(Set $set)
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
    public function superset(Set $set)
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
    public function union(Set $set)
    {
        $bit = $this->bit;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new self();
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
    public function intersect(Set $set)
    {
        $bit = $this->bit;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit &= $set->bit;
        }

        $clone = new self();
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
    public function diff(Set $set)
    {
        $bit = 0;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new self();
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
    public function symDiff(Set $set)
    {
        $bit = 0;
        foreach (func_get_args() as $set) {
            self::validateType($set);

            $bit |= $set->bit;
        }

        $clone = new self();
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
    public static function choices()
    {
        self::detectConstants();

        $choices = [];
        foreach (self::$keys[static::class] as $value) {
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

        return array_search($value, self::$keys[static::class]);
    }

    /**
     * @param mixed $value
     */
    private static function validateValue($value)
    {
        if (!static::isValid($value)) {
            throw OutOfEnumException::create($value, static::class);
        }
    }

    /**
     * @param object $object
     */
    private static function validateType($object)
    {
        if (self::class !== get_class($object)) {
            throw InvalidSetException::notInstanceOf(self::class, get_class($object));
        }
    }

    private static function detectConstants()
    {
        if (!isset(self::$bits[static::class])) {
            self::$keys[static::class] = [];
            self::$bits[static::class] = [];
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

            $bit = 1;
            foreach ($constants as $constant => $constant_value) {
                self::$keys[static::class][$constant] = $constant_value;
                self::$bits[static::class][$bit] = $constant_value;
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
        self::detectConstants();

        return self::$bits[static::class];
    }
}
