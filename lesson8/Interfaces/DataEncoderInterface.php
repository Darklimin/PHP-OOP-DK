<?php

declare(strict_types=1);

namespace MyProject\Interfaces;

interface DataEncoderInterface
{
    public function encodeData(array $content): string;

}
