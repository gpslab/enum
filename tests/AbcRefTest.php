<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests;

use GpsLab\Component\Enum\Tests\Enum\AbcRef;

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
    public function testCreate($value, $title)
    {
        $this->assertTrue(AbcRef::isValid($value));

        $channel = AbcRef::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(AbcRef::byValue($value)));
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Enum\AbcRef';
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
        $abc = AbcRef::a();
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
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedNamedConstruct()
    {
        AbcRef::undefined();
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\BadMethodCallException
     */
    public function testUndefinedMethod()
    {
        AbcRef::a()->undefined();
    }

    public function testIsA()
    {
        $this->assertEquals(AbcRef::A, AbcRef::a()->value());
        $this->assertTrue(AbcRef::a()->isA());
        $this->assertFalse(AbcRef::a()->isB());
    }

    public function testIsB()
    {
        $this->assertEquals(AbcRef::B, AbcRef::b()->value());
        $this->assertTrue(AbcRef::b()->isB());
        $this->assertFalse(AbcRef::b()->isA());
    }

    public function testIsC()
    {
        $this->assertEquals(AbcRef::C, AbcRef::c()->value());
        $this->assertTrue(AbcRef::c()->isC());
        $this->assertFalse(AbcRef::c()->isA());
    }
}
