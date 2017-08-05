<?php
namespace Werkspot\Enum\Tests\Util;

use PHPUnit_Framework_TestCase;
use Werkspot\Enum\Util\ClassNameConverter;

final class ClassNameConverterTest extends PHPUnit_Framework_TestCase
{
    /** @dataProvider getConversionData */
    public function testConvertClassNameToServiceName($class, $service)
    {
        $this->assertSame($service, ClassNameConverter::convertClassNameToServiceName($class));
    }

    /** @dataProvider getConversionData */
    public function testConvertServiceNameToClassName($class, $service)
    {
        $this->assertSame($class, ClassNameConverter::convertServiceNameToClassName($service));
    }

    /** @return array */
    public function getConversionData()
    {
        return [
            ['FooClass', 'foo_class'],
            ['BarBaz\\FooClass', 'bar_baz.foo_class'],
        ];
    }

    /** @dataProvider getNamespaceData */
    public function testStripNamespace($class, $fullClass)
    {
        $this->assertSame($class, ClassNameConverter::stripNameSpace($fullClass));
    }

    /** @return array */
    public function getNamespaceData()
    {
        return [
            ['FooClass', 'FooClass'],
            ['FooClass', 'BarBaz\\FooClass'],
            ['FooClass', 'Quux\\BarBaz\\FooClass'],
        ];
    }
}
