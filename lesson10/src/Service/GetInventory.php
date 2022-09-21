<?php

declare(strict_types=1);

namespace MyProject\Service;

class GetInventory
{
    public array $inventory;
    public array $indIds;

    public function getInventory(): array
    {
        $data = file_get_contents('./inventory.json');
        $this->inventory = json_decode($data, true);
        foreach ($this->inventory as $value) {
            $this->indIds[$value["product_id"]] = $value["quantity"];
        }

        return $this->indIds;
    }
}
