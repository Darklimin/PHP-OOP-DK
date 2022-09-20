<?php

declare(strict_types=1);

namespace MyProject\Service;

use MyProject\Exceptions\InputValidationException;
use MyProject\Exceptions\InventoryException;

class InventoryCheck
{
    public array $inventory;
    public array $checkArr = [];
    public array $finalArr = [];
    public array $finalFinalArr = [];
    public array $indIds;
    public bool $allOk = false;

    public function getInventory(): array
    {
        $data = file_get_contents('./inventory.json');
        $this->inventory = json_decode($data, true);
        foreach ($this->inventory as $value) {
            $this->indIds[$value["product_id"]] = $value["quantity"];
        }

        return $this->indIds;
    }

//    public function getCheck(string $input): array
//    {
//        if (preg_match("/\d+:\d+,\d+:\d+,\d+:\d+/", $input)) {
//            $this->checkArr = (explode(',', trim($input)));
//            foreach ($this->checkArr as $value) {
//                $this->finalArr[] = explode(':', $value);
//            }
//
//            foreach ($this->finalArr as $value) { /* Cia blogai kazkas gaunasi, kad i array patenka nepilnas narys*/
//                if (isset($value[0])) {
//                    if (isset($value[1])) {
//                        $this->finalFinalArr[(int)$value[0]] = (int)$value[1];
//                    }
//                }
//            }
//
//            return $this->finalFinalArr;
//        } else throw new InputValidationException("Invalid input $input Format: id:quantity,id:quantity");
//    }

    public function doCheck(): void
    {
        foreach ($this->finalFinalArr as $key => $value) {
            if (array_key_exists($key, $this->indIds)) {
                if ($value > $this->indIds[$key]) {
                    throw new InventoryException("product $key only has " . $this->indIds[$key] .
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
