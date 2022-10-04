<?php

declare(strict_types=1);

namespace DariusKliminskas\Pretest\Models;

class DataToFile
{
    public function toFile(): void
    {
        $data = file_get_contents('./data.json');
        $myAllMetaData = json_decode($data, true);
        if (strlen($_POST['product']) > 0 && strlen($_POST['price']) > 0) {
            $myAllMetaData[] = [
                'product' => $_POST['product'],
                'price' => $_POST['price'],
            ];
        }
        $serializedData = json_encode($myAllMetaData, JSON_PRETTY_PRINT);
        file_put_contents('./data.json', $serializedData);
    }

    public function fromFile(): array
    {
        $data = file_get_contents('./data.json');
        return json_decode($data, true);
    }

    public function deleteProduct(): void
    {
        $array = $this->fromFile();
        $myID = $_POST['delete'];
        $deleted = $array[$myID];
        if (key_exists($myID, $array)) {
            unset($array[$myID]);
            $serializedData[] = json_encode($array, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
        }
    }

    public function returnSum(): float
    {
        $sum = 0;
        $array = $this->fromFile();
        foreach ($array as $value) {
            $sum += $value['price'];
        }

        return $sum;
    }

    public function addDiscount(): float
    {
        $output = 0;
        $disc = intval($_POST['discount']);
        if ($disc > 0) {
            $sum = $this->returnSum();
            $output = $sum - ($sum / 100 * $disc);
        }

        return $output;
    }

    public function deleteList(): void
    {
        $myAllMetaData = [];
        $serializedData = json_encode($myAllMetaData, JSON_PRETTY_PRINT);
        file_put_contents('./data.json', $serializedData);
    }
}
