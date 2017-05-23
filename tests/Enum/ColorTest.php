<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\Tests\Fixture\Enum\ColorBW;

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

    /**
     * @var array
     */
    private $names = [
        ColorBW::RED => 'RED',
        ColorBW::GREEN => 'GREEN',
        ColorBW::BLUE => 'BLUE',
        ColorBW::BLACK => 'BLACK',
        ColorBW::WHITE => 'WHITE',
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
    public function testByValue($value, $title)
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
        $this->assertEquals($value, ColorBW::byName($name)->value());
    }

    /**
     * @dataProvider getNamesData
     *
     * @param string $value
     * @param string $name
     */
    public function testName($value, $name)
    {
        $this->assertEquals($name, ColorBW::byValue($value)->name());
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Fixture\Enum\ColorBW';
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
        $color = ColorBW::RED();
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
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testNameNotSupported()
    {
        ColorBW::byName('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testUndefinedNamedConstruct()
    {
        ColorBW::undefined();
    }

    public function testIsRed()
    {
        $this->assertEquals(ColorBW::RED, ColorBW::RED()->value());
        $this->assertEquals(ColorBW::RED(), ColorBW::RED());
        $this->assertTrue(ColorBW::RED()->equals(ColorBW::RED()));
        $this->assertFalse(ColorBW::RED()->equals(ColorBW::GREEN()));
    }

    public function testIsGreen()
    {
        $this->assertEquals(ColorBW::GREEN, ColorBW::GREEN()->value());
        $this->assertEquals(ColorBW::GREEN(), ColorBW::GREEN());
        $this->assertTrue(ColorBW::GREEN()->equals(ColorBW::GREEN()));
        $this->assertFalse(ColorBW::GREEN()->equals(ColorBW::RED()));
    }

    public function testIsBlue()
    {
        $this->assertEquals(ColorBW::BLUE, ColorBW::BLUE()->value());
        $this->assertEquals(ColorBW::BLUE(), ColorBW::BLUE());
        $this->assertTrue(ColorBW::BLUE()->equals(ColorBW::BLUE()));
        $this->assertFalse(ColorBW::BLUE()->equals(ColorBW::RED()));
    }

    public function testIsBlack()
    {
        $this->assertEquals(ColorBW::BLACK, ColorBW::BLACK()->value());
        $this->assertEquals(ColorBW::BLACK(), ColorBW::BLACK());
        $this->assertTrue(ColorBW::BLACK()->equals(ColorBW::BLACK()));
        $this->assertFalse(ColorBW::BLACK()->equals(ColorBW::RED()));
    }

    public function testIsWhite()
    {
        $this->assertEquals(ColorBW::WHITE, ColorBW::WHITE()->value());
        $this->assertEquals(ColorBW::WHITE(), ColorBW::WHITE());
        $this->assertTrue(ColorBW::WHITE()->equals(ColorBW::WHITE()));
        $this->assertFalse(ColorBW::WHITE()->equals(ColorBW::RED()));
    }

    public function testCreateStatic()
    {
        $ref = new \ReflectionClass('GpsLab\Component\Enum\ReflectionEnum');
        // method setStaticPropertyValue() is not work for private properties
        $property = $ref->getProperty('instances');
        $property->setAccessible(true);
        $property->setValue([]);

        ColorBW::RED();
    }
}
