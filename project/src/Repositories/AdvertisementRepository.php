<?php

namespace MyProject\Repositories;

use MyProject\Models\Advertisement;

class AdvertisementRepository
{

    public function getAll(): array
    {
        $data = file_get_contents('data.json', true);
        $advertisements = json_decode($data, true);

        return $advertisements;
    }

//Čia jei kitu būdu, su Advertisement jei daryčiau
//    public function create(array $fields) {
//
//        $advertisements = $this->getAll();
//        $advertisements[] = $fields;
//        $this->saveToFile($advertisements);
//    }
//
//    private function saveToFile(array $list) {
//        $data = json_encode($list, JSON_PRETTY_PRINT);
//        file_put_contents('data.json', $data);
//    }
}
