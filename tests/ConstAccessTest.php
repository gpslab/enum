<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests;

use GpsLab\Component\Enum\Tests\Enum\ConstAccess;

class ConstAccessTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $choices = [];

    public function setUp()
    {
        if (PHP_VERSION_ID < 70100) {
            $this->markTestSkipped('This test is for PHP-7.1 and upper only');
        }

        $this->choices = [
            ConstAccess::ACTION_GET => 'acme.demo.const_access.action_get',
            ConstAccess::ACTION_POST => 'acme.demo.const_access.action_post',
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
    public function testCreate($value, $title)
    {
        $this->assertTrue(ConstAccess::isValid($value));

        $channel = ConstAccess::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(ConstAccess::byValue($value)));
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Enum\ConstVisibility';
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
        $action = ConstAccess::actionGet();
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
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedNamedConstruct()
    {
        ConstAccess::undefined();
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedMethod()
    {
        ConstAccess::actionGet()->undefined();
    }

    public function testIsRed()
    {
        $this->assertEquals(ConstAccess::ACTION_GET, ConstAccess::actionGet()->value());
        $this->assertTrue(ConstAccess::actionGet()->isActionGet());
        $this->assertFalse(ConstAccess::actionGet()->isActionPost());
    }
}
