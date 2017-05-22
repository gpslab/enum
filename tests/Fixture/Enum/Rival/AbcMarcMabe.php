<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum\Rival;

use MabeEnum\Enum;

/**
 * @method static AbcMarcMabe A()
 * @method static AbcMarcMabe B()
 * @method static AbcMarcMabe C()
 */
class AbcMarcMabe extends Enum
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @return Enum[]
     */
    public static function values()
    {
        $values = [];
        foreach (self::getConstants() as $name => $value) {
            $values[$name] = self::byValue($value);
        }

        return $values;
    }

    /**
     * @return array
     */
    public static function choices()
    {
        $choices = [];
        foreach (self::values() as $value) {
            $choices[$value->getValue()] = (string) $value;
        }

        return $choices;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.abc.'.strtolower(parent::__toString());
    }
}
