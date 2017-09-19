<?php

declare(strict_types=1);

namespace Werkspot\Enum\Tests\Util;

use PHPUnit\Framework\TestCase;
use Werkspot\Enum\Util\ClassNameConverter;

final class ClassNameConverterTest extends TestCase
{
    /**
     * @dataProvider getConversionData
     */
    public function testConvertClassNameToServiceName(string $class, string $service): void
    {
        $this->assertSame($service, ClassNameConverter::convertClassNameToServiceName($class));
    }

    /**
     * @dataProvider getConversionData
     */
    public function testConvertServiceNameToClassName(string $class, string $service): void
    {
        $this->assertSame($class, ClassNameConverter::convertServiceNameToClassName($service));
    }

    public function getConversionData(): array
    {
        return [
            ['FooClass', 'foo_class'],
            ['BarBaz\\FooClass', 'bar_baz.foo_class'],
        ];
    }

    /**
     * @dataProvider getNamespaceData
     */
    public function testStripNamespace(string $class, string $fullClass): void
    {
        $this->assertSame($class, ClassNameConverter::stripNameSpace($fullClass));
    }

    public function getNamespaceData(): array
    {
        return [
            ['FooClass', 'FooClass'],
            ['FooClass', 'BarBaz\\FooClass'],
            ['FooClass', 'Quux\\BarBaz\\FooClass'],
        ];
    }
}
