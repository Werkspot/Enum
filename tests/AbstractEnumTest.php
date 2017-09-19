<?php

declare(strict_types=1);

namespace Werkspot\Enum\Tests;

use PHPUnit\Framework\TestCase;

final class AbstractEnumTest extends TestCase
{
    public function testEnum(): void
    {
        $a = FooEnum::get(FooEnum::A);
        $b = FooEnum::get(FooEnum::B);

        $this->assertSame(FooEnum::A, $a->getValue());
        $this->assertSame(FooEnum::B, $b->getValue());
        $this->assertSame(FooEnum::A, (string) $a);
        $this->assertSame(FooEnum::B, (string) $b);
    }

    public function testNull(): void
    {
        $nullEnum = FooEnum::get(null);
        $this->assertNull($nullEnum->getValue());
        $this->assertSame('', (string) $nullEnum);
    }

    public function testInteger(): void
    {
        $integerEnum = FooEnum::get(3);
        $this->assertSame(3, $integerEnum->getValue());
        $this->assertSame('3', (string) $integerEnum);
    }

    public function testSingleton(): void
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
    public function testException($illegalValue): void
    {
        FooEnum::get($illegalValue);
    }

    public function getExceptionData(): array
    {
        return [
            ['a'],
            ['bee'],
            ['B '],
            ['C'],
            [true],
        ];
    }

    public function testGetValidOptions(): void
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
