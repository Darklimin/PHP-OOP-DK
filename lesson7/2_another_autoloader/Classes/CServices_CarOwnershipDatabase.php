<?php

namespace MyProject\Services;

use MyProject\Containers\CarOwnerContainer;
use MyProject\Models\Car;
use MyProject\Models\Owner;

class CarOwnershipDatabase {

    public function __construct(private CarOwnerContainer $container) {}

    /**
     * @returns Owner[]
     */
    public function getOwners(): array {
        return $this->container->owners;
    }

    /**
     * @return Car[]
     */
    public function getOwnersCars(Owner $owner): array {
        $result = [];

        foreach ($owner->cars as $carId) {
            try {
                $result[] = $this->getCarById($carId);
            } catch (\Exception $exception) {
                echo ' - ' . $exception->getMessage() . PHP_EOL;
            }
        }

        return $result;
    }

    private function getCarById(string $id): Car {
        foreach ($this->container->cars as $car)
            if ($car->id == $id) {
                return $car;
            }
        throw new \Exception('No Car ID');
    }

}
