<?php

declare(strict_types=1);

namespace MyProject\Classes\OutputHandlers;

use MyProject\Interfaces\DataOutputHandlerInterface;

class JsonFileOutputHandler implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        file_put_contents('./output.json', $input);
        echo 'Data to file was written';
    }
}
