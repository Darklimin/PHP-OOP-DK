<?php

declare(strict_types=1);

namespace MyProject\Interfaces;

interface DataOutputHandlerInterface
{
    public function processData(string $input): void;
}
