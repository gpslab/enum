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
 * @method static DefMarcMabe D()
 * @method static DefMarcMabe E()
 * @method static DefMarcMabe F()
 */
class DefMarcMabe extends Enum
{
    const D = 1;
    const E = 2;
    const F = 3;

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
        return 'acme.demo.def.'.strtolower(parent::__toString());
    }
}
