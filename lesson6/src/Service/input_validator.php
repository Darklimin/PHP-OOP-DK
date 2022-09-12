<?php

declare(strict_types=1);

require './src/Exceptions/input_validator_exeption.php';

class InputValidator
{
    public array $checkArr;
    public array $finalArr;
    public array $array;

    public function getChe(string $input): array {

        $this->checkArr = (explode(',', trim($input)));

        foreach ($this->checkArr as $value) {
            $this->finalArr[] = explode(':', $value);
        }

        foreach ($this->finalArr as $value) {
            if (isset($value[0]) && isset($value[1])) {
                if (is_numeric($value[0]) && is_numeric($value[1])) {
                    $this->array[$value[0]] = $value[1];
                } else
                    throw new InputValidationException("Invalid input $input Format: id:quantity,id:quantity");
            }
        }

        return $this->array;
    }
}
