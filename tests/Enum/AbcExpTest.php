<?php

/**
 * Carousel project.
 *
 * @author Peter Gribanov <PGribanov@1tv.com>
 */

namespace GpsLab\Component\Enum\Tests\Enum;

use GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp;

class AbcExpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $choices = [
        AbcExp::A => 'acme.demo.abc.a',
        AbcExp::B => 'acme.demo.abc.b',
        AbcExp::C => 'acme.demo.abc.c',
    ];

    public function testChoices()
    {
        $this->assertEquals($this->choices, AbcExp::choices());
    }

    public function testValues()
    {
        $values = [];
        foreach (AbcExp::values() as $value) {
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
        $channel = AbcExp::byValue($value);

        $this->assertEquals($value, $channel->value());
        $this->assertEquals($title, (string) $channel);
        $this->assertTrue($channel->equals(AbcExp::byValue($value)));
    }

    /**
     * @return array
     */
    public function getSerializeData()
    {
        $class = 'GpsLab\Component\Enum\Tests\Fixture\Enum\AbcExp';
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
        $this->assertEquals($result, serialize(AbcExp::byValue($value)));
    }

    /**
     * @dataProvider getSerializeData
     *
     * @param string $value
     * @param string $result
     */
    public function testUnserialize($value, $result)
    {
        $this->assertEquals(AbcExp::byValue($value), unserialize($result));
    }

    /**
     * @expectedException \LogicException
     */
    public function testClone()
    {
        $abc = AbcExp::byValue(AbcExp::A);
        $abc = clone $abc;
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testValueNotSupported()
    {
        AbcExp::byValue('foo');
    }

    public function testIsA()
    {
        $this->assertEquals(AbcExp::A, AbcExp::byValue(AbcExp::A)->value());
        $this->assertEquals(AbcExp::byValue(AbcExp::A), AbcExp::byValue(AbcExp::A));
        $this->assertTrue(AbcExp::byValue(AbcExp::A)->equals(AbcExp::byValue(AbcExp::A)));
        $this->assertFalse(AbcExp::byValue(AbcExp::A)->equals(AbcExp::byValue(AbcExp::B)));
    }

    public function testIsB()
    {
        $this->assertEquals(AbcExp::B, AbcExp::byValue(AbcExp::B)->value());
        $this->assertEquals(AbcExp::byValue(AbcExp::B), AbcExp::byValue(AbcExp::B));
        $this->assertTrue(AbcExp::byValue(AbcExp::B)->equals(AbcExp::byValue(AbcExp::B)));
        $this->assertFalse(AbcExp::byValue(AbcExp::B)->equals(AbcExp::byValue(AbcExp::A)));
    }

    public function testIsC()
    {
        $this->assertEquals(AbcExp::C, AbcExp::byValue(AbcExp::C)->value());
        $this->assertEquals(AbcExp::byValue(AbcExp::C), AbcExp::byValue(AbcExp::C));
        $this->assertTrue(AbcExp::byValue(AbcExp::C)->equals(AbcExp::byValue(AbcExp::C)));
        $this->assertFalse(AbcExp::byValue(AbcExp::C)->equals(AbcExp::byValue(AbcExp::A)));
    }
}
