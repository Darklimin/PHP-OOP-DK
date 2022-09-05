<?php

declare(strict_types=1);

class Greeting
{
    public function __call($name, $arguments): void {
        echo 'Calling "' . $name . '" method witch doesnt exists with argument ' . implode(', ', $arguments)
        . PHP_EOL;
    }
}

$a = new Greeting();
$a->test('a');

abstract class Car
{
    public function drive(): void {
        echo 'car is driving';
    }

    abstract public function getRange(): void;
}
// $car = new Car(); - tai nėra įmanoma, nes klasė Car yra abstrakti
class ElectricCar extends Car
{
    public function getRange(): void {
        echo 'calculating range from remaining battery' . PHP_EOL;
    }
}

$electricCar = new ElectricCar();
$electricCar->getRange();
// calculating range from remaining battery
class DieselCar extends Car
{
    public function getRange(): void {
        echo 'calculating range from remaining fuel' . PHP_EOL;
    }
}

$dieselCar = new DieselCar();
$dieselCar->getRange();
$dieselCar->drive();
// calculating range from remaining fuel

