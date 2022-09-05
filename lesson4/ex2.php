<?php

declare(strict_types=1);

class Divisor
{
    public int $arg;
    public array $output;

    public function __construct(int $arg) {
        $this->arg = $arg;
    }

    public function __invoke (int $divider): array {
        for ($x = 1; $x < $this->arg; $x++) {
            if ($x % $divider === 0) {
                $this->output[] = $x;
            }
        }

        return $this->output;
    }
}

/*
Sukurkite klasę, kuri masyvo formatu grąžintų visus skaičius nuo 1 iki X, kurie dalijasi iš tam tikro skaičiaus.
Klasė turi būti iškviečiama kaip funkcija, daliklis paduodamas kaip argumentas.
Skaičius X turi būti paduodamas per konstruktorių. Skaičius turi būti teigiamas.
$divisor = new Divisor(1000);
print_r($divisor(10));
[
    10,
    20,
    ...
]
*/

$divisor = new Divisor(100);
print_r($divisor(10));