<?php

declare(strict_types=1);

namespace MyProject\Classes;

use MyProject\Interfaces\DataOutputHandlerInterface;

class XmlFileOutputHandler implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        file_put_contents('./output.xml', $input);
        echo 'Data to file was written';
    }
}
