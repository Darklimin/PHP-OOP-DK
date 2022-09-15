<?php

declare(strict_types=1);

namespace MyProject\Classes\Processor;

use MyProject\Classes\Encoders\JsonEncoder;
use MyProject\Classes\Encoders\XmlEncoder;
use MyProject\Classes\OutputHandlers\JsonFileOutputHandler;
use MyProject\Classes\OutputHandlers\TerminalOutputHandler;
use MyProject\Classes\OutputHandlers\XmlFileOutputHandler;


class DataProcessor
{
    public function __construct(private array $data) {}

    public string $out = '';

    public function process (string $format, string $output): void {
        $a = new JsonEncoder();
        $b = new TerminalOutputHandler();
        $c = new JsonFileOutputHandler();
        $d = new XmlEncoder();
        $e = new XmlFileOutputHandler();

        if ($format === 'json') {
            $this->out = $a->encodeData($this->data);
        } elseif ($format === 'xml') {
            $this->out = $d->encodeData($this->data);
        } else throw new \Exception('Wrong format command');

        if ($output === 'terminal') {
            $b->processData($this->out);
        } elseif ($output === 'file') {
            if ($format === 'json') {
                $c->processData($this->out);
            } elseif ($format === 'xml') {
                $e->processData($this->out);
            }
        } else throw new \Exception('Wrong output command');
    }
}
