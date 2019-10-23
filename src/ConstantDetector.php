<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum;

class ConstantDetector
{
    /**
     * @param string $class
     *
     * @return array
     */
    public static function detect($class)
    {
        $reflection = new \ReflectionClass($class);

        if (PHP_VERSION_ID >= 70100) {
            // Since PHP-7.1 visibility modifiers are allowed for class constants
            // for enumerations we are only interested in public once.
            $constants = [];
            foreach ($reflection->getReflectionConstants() as $constant) {
                if ($constant->isPublic()) {
                    $constants[$constant->getName()] = $constant->getValue();
                }
            }

            return $constants;
        }

        // In PHP < 7.1 all class constants were public by definition
        return $reflection->getConstants();
    }
}
