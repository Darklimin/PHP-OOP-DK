<?php

declare(strict_types=1);

namespace MyProject\Classes\Encoders;

use MyProject\Interfaces\DataEncoderInterface;

class JsonEncoder implements DataEncoderInterface
{
    public function encodeData(array $content): string
    {

        return json_encode($content, JSON_PRETTY_PRINT);
    }
}
