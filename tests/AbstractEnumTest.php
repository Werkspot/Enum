<?php
namespace Werkspot\Enum\Tests;

use PHPUnit_Framework_TestCase;

final class AbstractEnumTest extends PHPUnit_Framework_TestCase
{
    public function testEnum()
    {
        $a = FooEnum::get(FooEnum::A);
        $b = FooEnum::get(FooEnum::B);

        $this->assertSame(FooEnum::A, $a->getValue());
        $this->assertSame(FooEnum::B, $b->getValue());
        $this->assertSame(FooEnum::A, (string) $a);
        $this->assertSame(FooEnum::B, (string) $b);
    }

    public function testNull()
    {
        $nullEnum = FooEnum::get(null);
        $this->assertNull($nullEnum->getValue());
        $this->assertSame('', (string) $nullEnum);
    }

    public function testInteger()
    {
        $integerEnum = FooEnum::get(3);
        $this->assertSame(3, $integerEnum->getValue());
        $this->assertSame('3', (string) $integerEnum);
    }

    public function testSingleton()
    {
        $a = FooEnum::get(FooEnum::A);
        $a2 = FooEnum::get(FooEnum::A);
        $b = FooEnum::get(FooEnum::B);

        $this->assertSame($a, $a2);
        $this->assertNotSame($a, $b);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider getExceptionData
     */
    public function testException($illegalValue)
    {
        FooEnum::get($illegalValue);
    }

    public function getExceptionData()
    {
        return [
            ['a'],
            ['bee'],
            ['B '],
            ['C'],
            [true],
        ];
    }

    public function testGetValidOptions()
    {
        $this->assertSame(
            [
                FooEnum::A,
                FooEnum::B,
                FooEnum::A3,
                FooEnum::ANULL,
            ],
            FooEnum::getValidOptions()
        );
    }

}
