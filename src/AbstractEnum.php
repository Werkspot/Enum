<?php

declare(strict_types=1);

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

    public static function get($value): self
    {
        $class = get_called_class();
        $instanceKey = sprintf('%s.%s', $class, $value);

        if (!isset(static::$instances[$instanceKey])) {
            self::$instances[$instanceKey] = new $class($value);
        }

        return self::$instances[$instanceKey];
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        if ($this->value === null) {
            return '';
        }

        return (string) $this->value;
    }

    protected function isValid($value): bool
    {
        return in_array($value, $this->getValidOptions(), true);
    }

    public static function getValidOptions(): array
    {
        $reflection = new ReflectionClass(get_called_class());

        return array_values($reflection->getConstants());
    }

    protected function getClassName(): string
    {
        return ClassNameConverter::stripNameSpace(get_called_class());
    }
}
