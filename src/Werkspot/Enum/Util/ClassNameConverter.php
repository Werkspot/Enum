<?php
namespace Werkspot\Enum\Util;

class ClassNameConverter
{
    /**
     * In: ServicePro\SomeCommand
     * Out: service_pro.some_command
     *
     * @param string $className
     * @return string
     */
    public static function convertClassNameToServiceName($className)
    {
        // Namespace 'directories' should be '.', like 'ServicePro\Foo' => 'ServicePro.Foo'
        $className = str_replace('\\', '.', $className);

        // 'ServicePro.Foo' => 'service_pro._foo'
        $serviceName = lcfirst($className);
        $serviceName = preg_replace('/([A-Z])/', '_$1', $serviceName);

        // 'service_pro._foo' => 'service_pro.foo'
        $serviceName = str_replace('._', '.', $serviceName);
        return strtolower($serviceName);
    }

    /**
     * In: service_pro.some_command
     * Out: ServicePro\SomeCommand
     *
     * @param string $serviceName
     * @return string
     */
    public static function convertServiceNameToClassName($serviceName)
    {
        // Namespace 'directories' should be '.', like 'service_pro.foo_class' => 'service_pro\Foo_class'
        $className = preg_replace_callback('/\.([a-z])/', function($c) { return '\\' . ucfirst($c[1]); }, $serviceName);

        // 'service_pro\Foo_class' => 'ServicePro\FooClass'
        $className = preg_replace_callback('/_([a-z])/', function($c) { return ucfirst($c[1]); }, $className);
        return ucfirst($className);
    }

    /**
     * In: Some\Namespace\And\Class
     * Out: Class
     *
     * @param string $className
     * @return string
     */
    public static function stripNameSpace($className)
    {
        return preg_replace('|.+\\\\|', '', $className);
    }
}
