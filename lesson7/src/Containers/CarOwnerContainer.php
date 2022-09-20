<?php

namespace MyProject\Containers;

use MyProject\Models\Car;
use MyProject\Models\Owner;

class CarOwnerContainer {

    /**
     * @param Car[] $cars
     * @param Owner[] $owners
     */
    public function __construct(public array $cars, public array $owners) {}

}
