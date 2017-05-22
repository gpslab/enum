<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Set;

use GpsLab\Component\Enum\Tests\Fixture\Set\ConstAccess;

class ConstAccessTest extends \PHPUnit_Framework_TestCase
{
    public function testChoices()
    {
        if (PHP_VERSION_ID < 70100) {
            $this->markTestSkipped('This test is for PHP-7.1 and upper only');
        }

        $choices = [
            ConstAccess::ACTION_GET => 'acme.demo.const_access.action_get',
            ConstAccess::ACTION_POST => 'acme.demo.const_access.action_post',
        ];
        $set = new ConstAccess([ConstAccess::ACTION_GET, ConstAccess::ACTION_POST]);

        $this->assertEquals($choices, $set->choices());
    }
}
