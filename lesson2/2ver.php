<?php

declare(strict_types=1);

class Car {

    public string $command;
    public string $carNum;

    public function __construct ($arg) {
        if (array_key_exists(1, $arg)) {
            $this->command = $arg[1];
            if ($this->command === 'park_car') {
                $this->carNum = $arg[2];
            }
        } else {
            echo 'Bad command';
            die;
        }
    }

}

class Parking {

    public function actions(Car $car): void {
        if ($car->command === 'park_car') {
            $data = file_get_contents('./2ver.json');
            $deserializedData = json_decode($data, true);
            $deserializedData[] = $car->carNum;
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./2ver.json', $serializedData);
            echo 'Car ' . $car->carNum . ' parked!';
        } elseif ($car->command === 'list_cars') {
            $data = file_get_contents('./2ver.json');
            $deserializedData = json_decode($data, true);
            echo 'Parked cars: ' . PHP_EOL;
            foreach ($deserializedData as $value) {
                echo $value . PHP_EOL;
            }
        }
    }
}

$newCar = new Car($argv);
$newParking = new Parking();
$newParking->actions($newCar);