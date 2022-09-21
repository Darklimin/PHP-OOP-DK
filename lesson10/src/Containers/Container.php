<?php

declare(strict_types=1);

namespace MyProject\Containers;

use MyProject\Exceptions\ContainerArgumentTypeException;
use MyProject\Service\PrimitiveTypes;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use RuntimeException;

/**
 * Used internally by Container
 * @see Container
 */

class Container
{
    private array $resolvers = [];

    public function get(string $id)
    {
        if (!$this->has($id)) {
            return $this->resolve($id);
            // throw new RuntimeException("Class $id could not be resolved");
        }
        $resolve = $this->resolvers[$id];

        return $resolve($this);
    }

    private function resolve(string $id) {
        $refClass = new ReflectionClass($id); // https://www.php.net/manual/en/class.reflectionclass.php
        $refArguments = $this->getConstructorArguments($refClass);

        $dependencies = [];

        foreach ($refArguments as $refArgument) {
            try {
                $dependencies[] = $this->getFromReflectionArgument($refArgument);
            }
            catch (ContainerArgumentTypeException $e) {
                throw new RuntimeException(ContainerArgumentTypeException::messageForClass($id, $e));
            }
        }

        return $refClass->newInstanceArgs($dependencies);
    }

    /**
     * @return ReflectionParameter[]
     */
    private function getConstructorArguments(ReflectionClass $refClass): array {
        $refConstructor = $refClass->getConstructor();

        if (!$refConstructor)
            return []; // No arguments

        return $refConstructor->getParameters();
    }

    private function getFromReflectionArgument(ReflectionParameter $refArgument) {
        if (!$refArgument->hasType())
            throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_NO_TYPE);

        // todo: check if not primitive var
        $refType = $refArgument->getType();

        if (!($refType instanceof ReflectionNamedType))
            throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_NON_NAMED_TYPE);

        if (PrimitiveTypes::isPrimitive($refType->getName()))
            throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_PRIMITIVE_TYPE);

        $className = $refType->getName();
        return $this->get($className);
    }

    public function has(string $id): bool
    {
        return isset($this->resolvers[$id]);
    }

    public function set(string $id, callable $callable): void
    {
        $this->resolvers[$id] = $callable;
    }
}