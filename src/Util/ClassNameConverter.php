<?php
namespace Werkspot\Enum\Util;

final class ClassNameConverter
{
    /**
     * In: FooBar\BazQuux
     * Out: foo_bar.baz_quux
     *
     * @param string $className
     * @return string
     */
    public static function convertClassNameToServiceName($className)
    {
        $className = str_replace('\\', '.', $className);

        $serviceName = lcfirst($className);
        $serviceName = preg_replace('/([A-Z])/', '_$1', $serviceName);

        $serviceName = str_replace('._', '.', $serviceName);
        return strtolower($serviceName);
    }

    /**
     * In: foo_bar.baz_quux
     * Out: FooBar\BazQuux
     *
     * @param string $serviceName
     * @return string
     */
    public static function convertServiceNameToClassName($serviceName)
    {
        $className = preg_replace_callback('/\.([a-z])/', function($c) { return '\\' . ucfirst($c[1]); }, $serviceName);

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
