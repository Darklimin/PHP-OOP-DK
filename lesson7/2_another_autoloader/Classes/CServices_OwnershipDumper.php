<?php

namespace MyProject\Services;

class OwnershipDumper {

    public function dumpCars(array $cars) {
        foreach ($cars as $car)
            echo " - $car->id / $car->model".PHP_EOL;
    }

    public function dumpOwnersAndCars(CarOwnershipDatabase $database) {
        foreach ($database->getOwners() as $owner) {

            echo "$owner->name has cars:".PHP_EOL;

            $this->dumpCars($database->getOwnersCars($owner));
        }
    }

}
