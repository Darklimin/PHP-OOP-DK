<?php

declare(strict_types=1);

namespace MyProject\Service;

use MyProject\Exceptions\InventoryException;

class DoCheck
{
    public bool $allOk = false;

    public function doCheck($finalArray, $indIds): void
    {
        foreach ($finalArray as $key => $value) {
            if (array_key_exists($key, $indIds)) {
                if ($value > $indIds[$key]) {
                    throw new InventoryException("product $key only has " . $indIds[$key] .
                        " items in the inventory");
                } else {
                    $this->allOk = true;
                }
            } else {
                throw new InventoryException("product $key is not in the inventory");
            }
        }

        if ($this->allOk) {
            echo 'all products have the requested quantity in stock';
        }
    }
}
