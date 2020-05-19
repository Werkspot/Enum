<?php

declare(strict_types=1);

namespace Werkspot\Enum\Tests;

use BadMethodCallException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class AbstractEnumTest extends TestCase
{
    /**
     * @test
     */
    public function enum(): void
    {
        $a = TestEnum::get(TestEnum::A);
        $b = TestEnum::get(TestEnum::B);

        self::assertSame(TestEnum::A, $a->getValue());
        self::assertSame(TestEnum::B, $b->getValue());
        self::assertSame(TestEnum::A, (string) $a);
        self::assertSame(TestEnum::B, (string) $b);
    }

    /**
     * @test
     */
    public function null(): void
    {
        $nullEnum = TestEnum::get(null);
        self::assertNull($nullEnum->getValue());
        self::assertSame('', (string) $nullEnum);
    }

    /**
     * @test
     */
    public function integer(): void
    {
        $integerEnum = TestEnum::get(3);
        self::assertSame(3, $integerEnum->getValue());
        self::assertSame('3', (string) $integerEnum);
    }

    /**
     * @test
     */
    public function isShouldReturnTrueWhenComparingObjectsWithTheSameTypeAndValue(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertTrue($a->isA());
    }

    /**
     * @test
     */
    public function isShouldReturnFalseWhenComparingObjectsWithTheSameTypeAndDifferentValue(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertFalse($a->isB());
    }

    /**
     * @test
     */
    public function equalsShouldReturnTrueWhenComparingObjectsWithTheSameTypeAndValue(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertTrue($a->equals(TestEnum::get(TestEnum::A)));
    }

    /**
     * @test
     */
    public function equalsShouldReturnFalseWhenComparingObjectsWithTheSameTypeButDifferentValue(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertFalse($a->equals(TestEnum::get(TestEnum::B)));
    }

    /**
     * @test
     */
    public function equalsShouldReturnFalseWhenComparingObjectsWithTheSameValueButDifferentType(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertFalse($a->equals(Test2Enum::get(Test2Enum::A)));
    }

    /**
     * @test
     */
    public function equalsShouldReturnTrueWhenComparingObjectsWithDifferentTypeAndValue(): void
    {
        $a = TestEnum::get(TestEnum::A);

        self::assertFalse($a->equals(Test2Enum::get(Test2Enum::C)));
    }

    /**
     * @test
     */
    public function exceptionMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value [anything] is not matching any valid value of class "TestEnum". Valid values are [\'A\', \'BEE\', 1, 3, NULL, true].');
        TestEnum::get('anything');
    }

    /**
     * @test
     *
     * @dataProvider getInvertedCaseOptions
     *
     * @param mixed $option
     */
    public function getWithInvertedCaseIsIncorrect($option): void
    {
        $this->expectException(InvalidArgumentException::class);

        TestEnum::get($option);
    }

    public function getInvertedCaseOptions()
    {
        return [
            [strtolower(TestEnum::A)],
            [strtolower(TestEnum::B)],
        ];
    }

    /**
     * @test
     */
    public function getWithStrictEqualMatchThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        TestEnum::get('1');
    }


    /**
     * @test
     */
    public function isShouldAllowToCallMethodsBasedOnConstantNames(): void
    {
        $enum = TestEnum::nameWithUnderscore();

        self::assertInstanceOf(TestEnum::class, $enum);
        self::assertSame(TestEnum::NAME_WITH_UNDERSCORE, $enum->getValue());
    }

    /**
     * @test
     */
    public function isShouldThrowAnExceptionWhenWhenCallingAnInvalidMethod(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Werkspot\Enum\Tests\TestEnum::isDoesNotExist() does not exist.');

        $enum = TestEnum::a();
        $enum->isDoesNotExist();
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenWhenCallingAnInvalidStaticMethod(): void
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Werkspot\Enum\Tests\TestEnum::doesNotExist() does not exist.');

        TestEnum::doesNotExist();
    }

    /**
     * @test
     */
    public function getValidOptions(): void
    {
        self::assertSame(
            [
                TestEnum::A,
                TestEnum::B,
                TestEnum::A1,
                TestEnum::A3,
                TestEnum::ANULL,
                TestEnum::NAME_WITH_UNDERSCORE,
            ],
            TestEnum::getValidOptions()
        );
    }
}
