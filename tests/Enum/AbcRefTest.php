<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef;

class AbcRefTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $choices = [
        AbcRef::A => 'acme.demo.abc.a',
        AbcRef::B => 'acme.demo.abc.b',
        AbcRef::C => 'acme.demo.abc.c',
    ];

    /**
     * @var array
     */
    private $names = [
        AbcRef::A => 'A',
        AbcRef::B => 'B',
        AbcRef::C => 'C',
    ];

    public function testChoices()
    {
        $this->assertEquals($this->choices, AbcRef::choices());
    }

    public function testValues()
    {
        $values = [];
        foreach (AbcRef::values() as $value) {
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
        $channel = AbcRef::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(AbcRef::byValue($value)));
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
        $this->assertEquals($value, AbcRef::byName($name)->value());
    }

    /**
     * @dataProvider getNamesData
     *
     * @param string $value
     * @param string $name
     */
    public function testName($value, $name)
    {
        $this->assertEquals($name, AbcRef::byValue($value)->name());
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Fixture\Enum\AbcRef';
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
        $this->assertEquals($result, serialize(AbcRef::byValue($value)));
    }

    /**
     * @dataProvider getSerializeData
     *
     * @param string $value
     * @param string $result
     */
    public function testUnserialize($value, $result)
    {
        $this->assertEquals(AbcRef::byValue($value), unserialize($result));
    }

    /**
     * @expectedException \LogicException
     */
    public function testClone()
    {
        $abc = AbcRef::A();
        $abc = clone $abc;
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testValueNotSupported()
    {
        AbcRef::byValue('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testNameNotSupported()
    {
        AbcRef::byName('foo');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testUndefinedNamedConstruct()
    {
        AbcRef::undefined();
    }

    public function testEqualsA()
    {
        $this->assertEquals(AbcRef::A, AbcRef::A()->value());
        $this->assertEquals(AbcRef::A(), AbcRef::A());
        $this->assertTrue(AbcRef::A()->equals(AbcRef::A()));
        $this->assertFalse(AbcRef::A()->equals(AbcRef::B()));
    }

    public function testEqualsB()
    {
        $this->assertEquals(AbcRef::B, AbcRef::B()->value());
        $this->assertEquals(AbcRef::B(), AbcRef::B());
        $this->assertTrue(AbcRef::B()->equals(AbcRef::B()));
        $this->assertFalse(AbcRef::B()->equals(AbcRef::A()));
    }

    public function testEqualsC()
    {
        $this->assertEquals(AbcRef::C, AbcRef::C()->value());
        $this->assertEquals(AbcRef::C(), AbcRef::C());
        $this->assertTrue(AbcRef::C()->equals(AbcRef::C()));
        $this->assertFalse(AbcRef::C()->equals(AbcRef::A()));
    }

    public function testCreateStatic()
    {
        $ref = new \ReflectionClass('GpsLab\Component\Enum\ReflectionEnum');
        // method setStaticPropertyValue() is not work for private properties
        $property = $ref->getProperty('instances');
        $property->setAccessible(true);
        $property->setValue([]);

        AbcRef::A();
    }
}
