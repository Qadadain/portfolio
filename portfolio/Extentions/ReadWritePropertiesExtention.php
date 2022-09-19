<?php

namespace PHPStan\Rules\Properties;

use PHPStan\Reflection\PropertyReflection;

interface ReadWritePropertiesExtension
{
    public function isAlwaysRead(PropertyReflection $property, int $identifier): bool;

    public function isAlwaysWritten(PropertyReflection $property, string $propertyName): bool;

    public function isInitialized(PropertyReflection $property, string $propertyName): bool;
}
