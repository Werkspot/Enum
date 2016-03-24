<?php
namespace Werkspot\Enum\Tests\Util;

use PHPUnit_Framework_TestCase;
use Werkspot\Enum\Util\ClassNameConverter;

class ClassNameConverterTest extends PHPUnit_Framework_TestCase
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

    public function getConversionData()
    {
        return array(
            array('ServicePro', 'service_pro'),
            array('ServicePro\\FooClass', 'service_pro.foo_class'),
        );
    }

    /** @dataProvider getNamespaceData */
    public function testStripNamespace($class, $fullClass)
    {
        $this->assertSame($class, ClassNameConverter::stripNameSpace($fullClass));
    }

    public function getNamespaceData()
    {
        return array(
            array('ServicePro', 'ServicePro'),
            array('FooClass', 'ServicePro\\FooClass'),
            array('FooClass', 'Some\\ServicePro\\FooClass'),
        );
    }
}
