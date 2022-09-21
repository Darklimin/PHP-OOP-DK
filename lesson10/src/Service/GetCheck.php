<?php

declare(strict_types=1);

namespace MyProject\Service;

use MyProject\Exceptions\InputValidationException;

class GetCheck
{
    public array $checkArr = [];
    public array $finalArr = [];
    public array $finalFinalArr = [];

    public function getCheck(string $input): array
    {

        if (preg_match("/\d+:\d+,\d+:\d+,\d+:\d+/", $input)) {
            $this->checkArr = (explode(',', trim($input)));

            foreach ($this->checkArr as $value) {
                $this->finalArr[] = explode(':', $value);
            }

            foreach ($this->finalArr as $value) {
                if (isset($value[0])) {
                    if (isset($value[1])) {
                        $this->finalFinalArr[(int)$value[0]] = (int)$value[1];
                    }
                }
            }

            return $this->finalFinalArr;
        } else throw new InputValidationException("Invalid input $input Format: id:quantity,id:quantity");
    }
}