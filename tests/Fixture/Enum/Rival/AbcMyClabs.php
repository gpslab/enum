<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Fixture\Enum\Rival;

use MyCLabs\Enum\Enum;

/**
 * @method static AbcMyClabs A()
 * @method static AbcMyClabs B()
 * @method static AbcMyClabs C()
 */
class AbcMyClabs extends Enum
{
    const A = 1;
    const B = 2;
    const C = 3;

    /**
     * @var mixed[][]
     */
    private static $choices = [];

    /**
     * @return array
     */
    public static function choices()
    {
        $class = get_called_class();

        if (!isset(self::$choices[$class])) {
            self::$choices[$class] = [];
            foreach (self::values() as $value) {
                self::$choices[$class][$value->getValue()] = (string) $value;
            }
        }

        return self::$choices[$class];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'acme.demo.abc.'.strtolower($this->getKey());
    }
}
