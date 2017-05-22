<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
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
        $constants = [];
        $reflection = new \ReflectionClass($class);

        if (PHP_VERSION_ID >= 70100) {
            // Since PHP-7.1 visibility modifiers are allowed for class constants
            // for enumerations we are only interested in public once.
            foreach ($reflection->getReflectionConstants() as $constant) {
                if ($constant->isPublic()) {
                    $constants[$constant->getName()] = $constant->getValue();
                }
            }

            return $constants;
        }

        // In PHP < 7.1 all class constants were public by definition
        foreach ($reflection->getConstants() as $constant_name => $constant_value) {
            $constants[$constant_name] = $constant_value;
        }

        return $constants;
    }
}
