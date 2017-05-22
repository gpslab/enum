<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests;

use GpsLab\Component\Enum\Tests\Enum\ColorBW;

class ColorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $choices = [
        ColorBW::RED => 'acme.demo.color.red',
        ColorBW::GREEN => 'acme.demo.color.green',
        ColorBW::BLUE => 'acme.demo.color.blue',
        ColorBW::BLACK => 'acme.demo.color.black',
        ColorBW::WHITE => 'acme.demo.color.white',
    ];

    public function testChoices()
    {
        $this->assertEquals($this->choices, ColorBW::choices());
    }

    public function testValues()
    {
        $values = [];
        foreach (ColorBW::values() as $value) {
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
        $this->assertTrue(ColorBW::isValid($value));

        $channel = ColorBW::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(ColorBW::byValue($value)));
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Enum\ColorBW';
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
        $this->assertEquals($result, serialize(ColorBW::byValue($value)));
    }

    /**
     * @dataProvider getSerializeData
     *
     * @param string $value
     * @param string $result
     */
    public function testUnserialize($value, $result)
    {
        $this->assertEquals(ColorBW::byValue($value), unserialize($result));
    }

    /**
     * @expectedException \LogicException
     */
    public function testClone()
    {
        $color = ColorBW::red();
        $color = clone $color;
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testValueNotSupported()
    {
        ColorBW::byValue('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedNamedConstruct()
    {
        ColorBW::undefined();
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedMethod()
    {
        ColorBW::red()->undefined();
    }

    public function testIsRed()
    {
        $this->assertEquals(ColorBW::RED, ColorBW::red()->value());
        $this->assertTrue(ColorBW::red()->isRed());
        $this->assertFalse(ColorBW::red()->isGreen());
    }

    public function testIsGreen()
    {
        $this->assertEquals(ColorBW::GREEN, ColorBW::green()->value());
        $this->assertTrue(ColorBW::green()->isGreen());
        $this->assertFalse(ColorBW::green()->isRed());
    }

    public function testIsBlue()
    {
        $this->assertEquals(ColorBW::BLUE, ColorBW::blue()->value());
        $this->assertTrue(ColorBW::blue()->isBlue());
        $this->assertFalse(ColorBW::blue()->isRed());
    }

    public function testIsBlack()
    {
        $this->assertEquals(ColorBW::BLACK, ColorBW::black()->value());
        $this->assertTrue(ColorBW::black()->isBlack());
        $this->assertFalse(ColorBW::black()->isRed());
    }

    public function testIsWhite()
    {
        $this->assertEquals(ColorBW::WHITE, ColorBW::white()->value());
        $this->assertTrue(ColorBW::white()->isWhite());
        $this->assertFalse(ColorBW::white()->isRed());
    }
}
