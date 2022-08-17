<?php

declare(strict_types=1);

/*
Sukurkite klasę NumberCalculator, kuri leistų atlikti įvairius skaičiavimo veiksmus. Ši klasė neturės konstruktoriaus.
Metodai:
- addNumber - metodas priims "int" tipo argumentą, return tipas bus "void"
- calculateSum - metodas grąžins "int" tipo reikšmę, argumentų neturės
- calculateProduct - product liet. sandauga. Metodas grąžins "int" tipo reikšmę, argumentų neturės
- calculateAverage - suapvalinkite iki sveiko skaičiaus, į viršų. Metodas grąžins "int" tipo reikšmę, argumentų neturės
Nepamirškite sudėti argumentų bei return tipų.
Kodo kvietimo pavyzdys:
$numberCalculator = new NumberCalculator();
echo $numberCalculator->calculateSum(); // 0
$numberCalculator->addNumber(5);
$numberCalculator->addNumber(7);
echo $numberCalculator->calculateSum(); // 12
*/

class NumberCalculator {
    private array $numbers;

    public function addNumber(int $input): void {
        $this->numbers[] = $input;
    }

    public function calculateSum(): int {
        $sum = 0;
        foreach ($this->numbers as $value){
            $sum += $value;
        }
        return $sum;
    }

    public function calculateProduct(): int {
        $multi = 1;
        foreach ($this->numbers as $value){
            $multi *= $value;
        }
        return $multi;
    }

    public function calculateAverage(): float {
        $sum = 0;
        $count = count($this->numbers);
        foreach ($this->numbers as $value){
            $sum += $value;
        }
        return (int)round($sum / $count, 0);
    }
}
$numberCalculator = new NumberCalculator();
$numberCalculator->addNumber(5);
$numberCalculator->addNumber(8);
echo $numberCalculator->calculateSum() . PHP_EOL;
echo $numberCalculator->calculateProduct() . PHP_EOL;
echo $numberCalculator->calculateAverage();
