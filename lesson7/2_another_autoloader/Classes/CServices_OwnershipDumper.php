<?php

namespace MyProject\Services;

class OwnershipDumper {

    public static function dumpCars(array $cars) {
        foreach ($cars as $car)
            echo " - $car->id / $car->model".PHP_EOL;
    }

    public static function dumpOwnersAndCars(CarOwnershipDatabase $database) {
        foreach ($database->getOwners() as $owner) {

            echo "$owner->name has cars:".PHP_EOL;

            OwnershipDumper::dumpCars($database->getOwnersCars($owner));
        }
    }

}
