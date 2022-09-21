<?php

namespace MyProject\Exceptions;

use Exception;

class ContainerArgumentTypeException extends Exception {

    public const ISSUE_NO_TYPE = 'no_type';
    public const ISSUE_NON_NAMED_TYPE = 'non_named_type'; // Is not a simple named type (union or intersection)
    public const ISSUE_PRIMITIVE_TYPE = 'primitive_type';


    public function __construct(private string $argumentName, private string $issue) {}

    public function getArgumentName() { return $this->argumentName; }

    public function getIssue(): string { return $this->issue; }

    public static function messageForClass(string $className, \MyProject\Exceptions\ContainerArgumentTypeException $exception) {
        $identifier = "$className::__construct(\${$exception->getArgumentName()})";

        switch ($exception->getIssue()) {
            case ContainerArgumentTypeException::ISSUE_NO_TYPE:
                return "Argument has no type: $identifier";
            case ContainerArgumentTypeException::ISSUE_NON_NAMED_TYPE:
                return "Argument type is too complex (avoid using unions | and intersections &): $identifier";
            case ContainerArgumentTypeException::ISSUE_PRIMITIVE_TYPE:
                return "Cannot resolve primitive arguments (use Container::set): $identifier";
        }
    }

}
