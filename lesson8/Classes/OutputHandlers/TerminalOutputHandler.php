<?php

declare(strict_types=1);

namespace MyProject\Classes\OutputHandlers;

use MyProject\Interfaces\DataOutputHandlerInterface;

class TerminalOutputHandler implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        var_dump($input);
    }
}