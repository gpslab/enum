<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Tests\Set;

use GpsLab\Component\Enum\Tests\Fixture\Set\AbcRef;
use GpsLab\Component\Enum\Tests\Fixture\Set\DefRef;
use PHPUnit\Framework\TestCase;

class AbcRefTest extends TestCase
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
     * @var AbcRef
     */
    private $a;

    /**
     * @var AbcRef
     */
    private $b;

    protected function setUp()
    {
        $this->a = new AbcRef(array_keys($this->choices));
        $this->b = new AbcRef();
    }

    public function testConstruct()
    {
        foreach ($this->choices as $value => $title) {
            $this->assertTrue($this->a->contains($value));
            $this->a->attach($value);
            $this->assertTrue($this->a->contains($value));
            $this->a->detach($value);
            $this->assertFalse($this->a->contains($value));
        }
    }

    public function testValues()
    {
        $this->assertEquals([], $this->b->values());
        $this->assertEquals(array_keys($this->choices), $this->a->values());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testAttachUndefined()
    {
        $this->a->attach('undefined');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testDetachUndefined()
    {
        $this->a->detach('undefined');
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\OutOfEnumException
     */
    public function testContainsUndefined()
    {
        $this->a->contains('undefined');
    }

    public function testChoices()
    {
        foreach ($this->choices as $value => $title) {
            $this->b->attach($value);
        }

        $this->assertEquals($this->choices, $this->b->choices());
    }

    public function testReadable()
    {
        foreach ($this->choices as $value => $title) {
            $this->assertEquals($title, AbcRef::readable($value));
        }
    }

    public function testEqual()
    {
        foreach ($this->choices as $value => $title) {
            $this->b->attach($value);
        }

        $this->assertTrue($this->a->equal($this->b));
    }

    public function testNotEqual()
    {
        $this->assertTrue($this->a->equal($this->b));
    }

    public function testSubset()
    {
        $this->b->attach(array_keys($this->choices)[0]);

        $this->assertTrue($this->b->subset($this->a));
        $this->assertFalse($this->a->subset($this->b));
    }

    public function testSuperset()
    {
        $this->b->attach(array_keys($this->choices)[0]);

        $this->assertFalse($this->b->superset($this->a));
        $this->assertTrue($this->a->superset($this->b));
    }

    public function testUnion()
    {
        $new = $this->b->union(
            new AbcRef([AbcRef::A]),
            new AbcRef([AbcRef::B, AbcRef::C])
        );

        $this->assertNotEquals($new, $this->b);
        $this->assertEquals(array_keys($this->choices), $new->values());
    }

    public function testIntersect()
    {
        $a = new AbcRef([AbcRef::A, AbcRef::B]);
        $b = new AbcRef([AbcRef::B, AbcRef::C]);
        $new = $b->intersect($a);

        $this->assertNotEquals($new, $b);
        $this->assertEquals([AbcRef::B], $new->values());
    }

    public function testDiff()
    {
        $a = new AbcRef([AbcRef::A, AbcRef::B]);
        $b = new AbcRef([AbcRef::B, AbcRef::C]);

        $new = $b->diff($a);
        $this->assertNotEquals($new, $b);
        $this->assertEquals([AbcRef::C], $new->values());

        $new = $a->diff($b);
        $this->assertNotEquals($new, $a);
        $this->assertEquals([AbcRef::A], $new->values());
    }

    public function testSymDiff()
    {
        $a = new AbcRef([AbcRef::A, AbcRef::B]);
        $b = new AbcRef([AbcRef::B, AbcRef::C]);

        $new = $b->symDiff($a);
        $this->assertNotEquals($new, $b);
        $this->assertEquals([AbcRef::A, AbcRef::C], $new->values());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testEqualInvalid()
    {
        $this->a->equal(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testSubsetInvalid()
    {
        $this->a->subset(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testSupersetInvalid()
    {
        $this->a->superset(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testUnionInvalid()
    {
        $this->a->union(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testIntersectInvalid()
    {
        $this->a->intersect(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testDiffInvalid()
    {
        $this->a->diff(new DefRef());
    }

    /**
     * @expectedException \GpsLab\Component\Enum\Exception\InvalidSetException
     */
    public function testSymDiffInvalid()
    {
        $this->a->symDiff(new DefRef());
    }
}
