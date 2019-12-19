<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\Tests\Fixture\Enum\ConstAccess;
use PHPUnit\Framework\TestCase;

class ConstAccessTest extends TestCase
{
    /**
     * @var array
     */
    private $choices = [];

    /**
     * @var array
     */
    private $names = [];

    protected function setUp()
    {
        if (PHP_VERSION_ID < 70100) {
            $this->markTestSkipped('This test is for PHP-7.1 and upper only');
        }

        $this->choices = [
            ConstAccess::ACTION_GET => 'acme.demo.const_access.action_get',
            ConstAccess::ACTION_POST => 'acme.demo.const_access.action_post',
        ];
        $this->names = [
            ConstAccess::ACTION_GET => 'ACTION_GET',
            ConstAccess::ACTION_POST => 'ACTION_POST',
        ];
    }

    public function testChoices()
    {
        $this->assertEquals($this->choices, ConstAccess::choices());
    }

    public function testValues()
    {
        $values = [];
        foreach (ConstAccess::values() as $value) {
            $values[] = $value->value();
        }
        sort($values);

        $this->assertEquals(array_keys($this->choices), $values);
    }

    /**
     * @return array
     */
    public function getChoicesData()
    {
        $this->setUp();
        $data = [];
        foreach ($this->choices as $value => $title) {
            $data[] = [$value, $title];
        }

        return $data;
    }

    /**
     * @dataProvider getChoicesData
     *
     * @param string $value
     * @param string $title
     */
    public function testByValue($value, $title)
    {
        $channel = ConstAccess::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(ConstAccess::byValue($value)));
    }

    /**
     * @return array
     */
    public function getNamesData()
    {
        $data = [];
        foreach ($this->names as $value => $name) {
            $data[] = [$value, $name];
        }

        return $data;
    }

    /**
     * @dataProvider getNamesData
     *
     * @param string $value
     * @param string $name
     */
    public function testByName($value, $name)
    {
        $this->assertEquals($value, ConstAccess::byName($name)->value());
    }

    /**
     * @dataProvider getNamesData
     *
     * @param string $value
     * @param string $name
     */
    public function testName($value, $name)
    {
        $this->assertEquals($name, ConstAccess::byValue($value)->name());
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $this->setUp();
        $class = 'GpsLab\Component\Enum\Tests\Fixture\Enum\ConstAccess';
        $class_len = strlen($class);

        $data = [];
        foreach ($this->choices as $value => $title) {
            $ser = serialize($value);
            $data[] = [
                $value,
                sprintf('C:%d:"%s":%d:{%s}', $class_len, $class, strlen($ser), $ser),
            ];
        }

        return $data;
    }

    /**
     * @dataProvider getSerializeData
     *
     * @param string $value
     * @param string $result
     */
    public function testSerialize($value, $result)
    {
        $this->assertEquals($result, serialize(ConstAccess::byValue($value)));
    }

    /**
     * @dataProvider getSerializeData
     *
     * @param string $value
     * @param string $result
     */
    public function testUnserialize($value, $result)
    {
        $this->assertEquals(ConstAccess::byValue($value), unserialize($result));
    }

    /**
     * @expectedException \LogicException
     */
    public function testClone()
    {
        $action = ConstAccess::ACTION_GET();
        $action = clone $action;
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testValueNotSupported()
    {
        ConstAccess::byValue('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testNameNotSupported()
    {
        ConstAccess::byName('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testUndefinedNamedConstruct()
    {
        ConstAccess::undefined();
    }

    public function testIsActionGet()
    {
        $this->assertEquals(ConstAccess::ACTION_GET, ConstAccess::ACTION_GET()->value());
        $this->assertEquals(ConstAccess::ACTION_GET(), ConstAccess::ACTION_GET());
        $this->assertTrue(ConstAccess::ACTION_GET()->equals(ConstAccess::ACTION_GET()));
        $this->assertFalse(ConstAccess::ACTION_GET()->equals(ConstAccess::ACTION_POST()));
    }

    public function testIsActionPost()
    {
        $this->assertEquals(ConstAccess::ACTION_POST, ConstAccess::ACTION_POST()->value());
        $this->assertEquals(ConstAccess::ACTION_POST(), ConstAccess::ACTION_POST());
        $this->assertTrue(ConstAccess::ACTION_POST()->equals(ConstAccess::ACTION_POST()));
        $this->assertFalse(ConstAccess::ACTION_POST()->equals(ConstAccess::ACTION_GET()));
    }

    public function testCreateStatic()
    {
        $ref = new \ReflectionClass('GpsLab\Component\Enum\ReflectionEnum');
        // method setStaticPropertyValue() is not work for private properties
        $property = $ref->getProperty('instances');
        $property->setAccessible(true);
        $property->setValue([]);

        ConstAccess::ACTION_GET();
    }
}
