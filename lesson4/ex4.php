<?php

declare(strict_types=1);

class Calculator
{
    public function sum(int $a, int $b): int {
        return $a + $b;
    }

    public function subtract(int $a, int $b): int {
        return $a - $b;
    }

    public function multiply(int $a, int $b): int {
        return $a * $b;
    }

    public function divide(int $a, int $b): float {
        if ($b != 0) {
            return round($a / $b, 2);
        }
        echo 'You cant divide from 0';
        die;
    }

    public function __call (string $method, array $times): void {
        if ($method === 'sumTimer') {
            $time_start = microtime(true);
            for ($x = 1; $x <= $times[0]; $x++) {
                self::sum(rand(), rand());
            }
            $time_end = microtime(true);
            echo 'It took ' . $time_end - $time_start . ' to do ' . $times[0] . ' sum() operations' . PHP_EOL;
        } elseif ($method === 'subtractTimer') {
            $time_start = microtime(true);
            for ($x = 1; $x <= $times[0]; $x++) {
                self::subtract(rand(), rand());
            }
            $time_end = microtime(true);
            echo 'It took ' . $time_end - $time_start . ' to do ' . $times[0] . ' subtract() operations' . PHP_EOL;
        } elseif ($method === 'multiplyTimer') {
            $time_start = microtime(true);
            for ($x = 1; $x <= $times[0]; $x++) {
                self::multiply(rand(), rand());
            }
            $time_end = microtime(true);
            echo 'It took ' . $time_end - $time_start . ' to do ' . $times[0] . ' multiply() operations' . PHP_EOL;
        } elseif ($method === 'divideTimer') {
            $time_start = microtime(true);
            for ($x = 1; $x <= $times[0]; $x++) {
                self::multiply(rand(), rand());
            }
            $time_end = microtime(true);
            echo 'It took ' . $time_end - $time_start . ' to do ' . $times[0] . ' divide() operations' . PHP_EOL;
        }
    }
}

/*
1.0 - pasiruošimas
Klasei pridėkite veikiančius metodus sum($a, $b), subtract($a, $b)
Dirbama su sveikaisiais skaičiais (int)
Panaudojimo pavyzdys:
$calc = new Calculator();
$calc->sum(1, 4); // grąžina 5
$calc->subtract(10, 1); // grąžina 9
1.1
Norime, kad klasė skaičiuotų bet savo metodų vykdymo trukmę, N kartų kviečiant ją su atsitiktinėmis reikšmėmis.
Chronometras kviečiamas per funkciją pavadinimu "<operacija>Timer" perduodant įvykdymų kiekį:
$calc->sumTimer(5000); // 5000 kartų kviečiamas sum() metodas su atsitiktinėmis reikšmėmis
$calc->subtractTimer(1_000_000); // milijoną kartų kviečiamas subtract() metodas su atsitiktinėmis reikšmėmis
Chronometras per echo() išveda:
'It took 0.017563104629517 to do 5000 sum() operations'
- Paskaitos skaidrėse rasite magišką metodą, kuris leis jums atlikti užduotį
- atsitiktines reikšmės generuojame su rand() arba random_int()
- Laikas skaičiuojamas su microtime(true) pagalba
1.2
Klasei pridėkite metodą multiply() (daugyba), išbandykite $calc->multiplyTimer(1_000_000);
Galite pridėti ir divide(), tačiau turite apsisaugoti nuo dalybos iš nulio
---------
Kadangi klasė neturi vidinės būsenos, objektų naudojimas neprivalomas.
Užduotį galima atlikti ir su statiniais metodais (funkcijomis).
Tokiu atveju naudojamas kitas magiškas metodas.
*/

$calc = new Calculator();
echo $calc->sum(1, 4) . PHP_EOL; // grąžina 5
echo $calc->subtract(10, 1) . PHP_EOL; // grąžina 9
$calc->sumTimer(5000);
$calc->subtractTimer(1_000_000);
echo $calc->multiply(5, 4) . PHP_EOL;
echo $calc->divide(15, 3) . PHP_EOL;
$calc->multiplyTimer(5000);
$calc->divideTimer(1_000_000);