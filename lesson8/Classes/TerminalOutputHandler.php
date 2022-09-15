<?php

declare(strict_types=1);

namespace MyProject\Classes;

use MyProject\Interfaces\DataOutputHandlerInterface;

class TerminalOutputHandler implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        var_dump($input);
    }
}