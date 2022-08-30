<?php

declare(strict_types=1);

/*

Sukurkite programą skirtą valdyti parkingą. Naudokite objektinį programavimą t.y. klases.
Turbūt pakaks dviejų klasių - Parking ir Car. Duomenys turi būti saugomi faile.
---------------------------------------------
php -f parking.php park_car NKA_123
Car ABC_123 parked!
---------------------------------------------
php -f parking.php park_car FTA_122
Car FTA_122 parked!
---------------------------------------------
php -f parking.php list_cars
Parked cars:
NKA_123
FTA_122

*/

class Car
{

    public function __construct(array $argument) {
        if ($argument[1] === 'park_car') {
            $data = file_get_contents('./parked.json');
            $deserializedData = json_decode($data, true);
            $deserializedData[] = $argument[2];
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./parked.json', $serializedData);
            echo 'Car ' . $argument[2] . ' parked!';
        }
    }

    public function listCars(array $argument): void {
        if ($argument[1] === 'list_cars') {
            $data = file_get_contents('./parked.json');
            $deserializedData = json_decode($data, true);
            echo 'Parked cars: ' . PHP_EOL;
            foreach ($deserializedData as $value) {
                echo $value . PHP_EOL;
            }
        }
    }
}

$newCar = new Car($argv);
$newCar->listCars($argv);
