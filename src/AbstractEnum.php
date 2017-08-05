<?php
namespace Werkspot\Enum;

use InvalidArgumentException;
use ReflectionClass;
use Werkspot\Enum\Util\ClassNameConverter;

abstract class AbstractEnum
{
    protected $value;
    protected static $instances = array();

    protected function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidArgumentException(sprintf('Invalid %s value: \'%s\'', $this->getClassName(), $value));
        }

        $this->value = $value;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public static function get($value)
    {
        $class = get_called_class();
        $instanceKey = sprintf('%s.%s', $class, $value);

        if (!isset(static::$instances[$instanceKey])) {
            self::$instances[$instanceKey] = new $class($value);
        }

        return self::$instances[$instanceKey];
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        if ($this->value === null) {
            return '';
        }

        return (string) $this->value;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    protected function isValid($value)
    {
        return in_array($value, $this->getValidOptions(), true);
    }

    /**
     * @return array
     */
    public static function getValidOptions()
    {
        $reflection = new ReflectionClass(get_called_class());

        return array_values($reflection->getConstants());
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return ClassNameConverter::stripNameSpace(get_called_class());
    }
}
