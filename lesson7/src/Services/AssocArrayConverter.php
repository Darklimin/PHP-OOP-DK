<?php

declare(strict_types=1);

namespace MyProject\Services;

use MyProject\Models\Car;
use MyProject\Models\Owner;

/** Returns specific data objects from loosely defined associative arrays (from JSON file) */
class AssocArrayConverter {

    public static function toCar($params): Car {
        return new Car($params['model'], $params['id']);
    }

    public static function toOwner($params): Owner {
        return new Owner($params['name'], $params['cars']);
    }

    /**
     * @return Car[]
     */
    public function toCars(array $list): array {
        $result = [];

        foreach ($list as $item)
            $result[] = AssocArrayConverter::toCar($item);

        return $result;
    }

    /**
     * @return Owner[]
     */
    public function toOwners(array $list): array {
        $result = [];

        foreach ($list as $item)
            $result[] = AssocArrayConverter::toOwner($item);

        return $result;
    }

}
