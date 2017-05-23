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
     * @var mixed[][]
     */
    private static $choices = [];

    /**
     * @return Enum[]
     */
    public static function values()
    {
        $class = get_called_class();

        if (!isset(self::$choices[$class])) {
            self::$choices[$class] = [];
            foreach (self::getConstants() as $name => $value) {
                self::$choices[$class][$name] = self::byValue($value);
            }
        }

        return self::$choices[$class];
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
