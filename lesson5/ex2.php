<?php

declare(strict_types=1);

class InventoryException extends \Exception {}

class InputValidationException extends \Exception {}

class InputValidator
{
    public array $checkArr;
    public array $finalArr;
    public array $array;

    public function getChe(string $input): array {

        $this->checkArr = (explode(',', trim($input)));

        foreach ($this->checkArr as $value) {
            $this->finalArr[] = explode(':', $value);
            var_dump($this->finalArr);
        }

        foreach ($this->finalArr as $value) {
            if (isset($value[0]) && isset($value[1])) {
                if (is_numeric($value[0]) && is_numeric($value[1])) {
                 $this->array[$value[0]] = $value[1];
                } else
                    throw new InputValidationException("Invalid input $input Format: id:quantity,id:quantity");
            }
        }

        return $this->array;
    }
}

class InventoryCheck
{
    public array $inventory;
    public array $checkArr = [];
    public array $finalArr = [];
    public array $finalFinalArr = [];
    public array $indIds;
    public bool $allOk = FALSE;

    public function getInventory(): array {
        $data = file_get_contents('./inventory.json');
        $this->inventory = json_decode($data, true);
        foreach ($this->inventory as $value) {
            $this->indIds[$value["product_id"]] = $value["quantity"];
        }

        return $this->indIds;
    }

    public function getCheck(string $input): array {
        $this->checkArr = (explode(',', trim($input)));
//var_dump($this->checkArr);
        foreach ($this->checkArr as $value) {
            $this->finalArr[] = explode(':', $value);
        }
        var_dump($this->finalArr);

        foreach ($this->finalArr as $value) { /* Cia blogai kazkas gaunasi, kad i array patenka nepilnas narys*/
            if (isset($value[0])) {
                var_dump(isset($value[0]));
                if (isset($value[1])) {
                    var_dump(isset($value[1]));
                    $this->finalFinalArr[(int)$value[0]] = (int)$value[1];
                }
            }
//            } else die;
        }
var_dump($this->finalArr);
        return $this->finalFinalArr;
    }

    public function doCheck(): void {
        foreach ($this->finalFinalArr as $key => $value) {
            if (array_key_exists($key, $this->indIds)){
                if ($value > $this->indIds[$key]) {
                    throw new InventoryException("product $key only has " . $this->indIds[$key] .
                        " items in the inventory");
                } else {
                    $this->allOk = TRUE;
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

//$validator = new InputValidator();
$inventory = new InventoryCheck();
$inventory->getInventory();
$inventory->getCheck($argv[1]);

try {
//    $validator->getChe($argv[1]);
    $inventory->doCheck();
} catch (InputValidationException $exception) {
    echo $exception->getMessage();
} catch (InventoryException $exception) {
    echo $exception->getMessage();
    file_put_contents('./log.txt', date("Y-m-d H:i:s") . ' ' .
        $exception->getMessage() . PHP_EOL, FILE_APPEND);
}

/*
2.1 Para??ykite ??rank?? inventoriaus tikrinimui. Inventori?? rasite faile "./inventory.json"
Programa tur??t?? veikti paduodant jai produkto id ir kiekio poras, atskirtas dvita??kiu. Pa??ios poros atskirtos kableliais:
Pvz.: php -f 2_inventory_checker.php "1:3,2:2,4:1" - rei??kia, kad mes norime patikrinti, ar inventoriuje egzistuoja:
- produktas, kurio id yra 1, o kiekis 3
- produktas, kurio id yra 2, o kiekis 2
- produktas, kurio id yra 4, o kiekis 1
Jeigu paduotas produkto id neegzistuoja, arba nepakanka kiekio, ?? terminal?? i??spausdinkite prane??im??:
- product "15" is not in the inventory
- product "5" only has 0 items in the inventory
Pakaks spausdinti tik vien?? klaid?? apie inventoriaus neatitikimus, net jeigu tikrinami keli nevalid??s produktai.
??alia klaidos prane??imo spausdinimo taip pat, ??ra??ykite prane??im?? apie ???? ??vyk?? ?? log'?? (log.txt)
Log'o ??ra??o formatas: 2020-01-01 15:15:15 product "15" is not in the inventory
U??duo??iai ??gyvendinti panaudokite exception'us.
Klas??, tikrinanti inventori??, turi mesti exception'us, o j?? kvie??iantis kodas - gaudyti. Naudokite savo custom
exception'o klas?? (pvz.: InventoryException).
Programos kvietimo pavyzdys:
php -f 2_inventory_checker.php "1:3,2:2,5:1"
product "5" only has 0 items in the inventory
php -f 2_inventory_checker.php "1:3,2:2"
all products have the requested quantity in stock
*/

/*
2.2 Patobulinkite 2.1 u??duoties ??rank?? - prid??kite inputo validatori?? (atskira klas??)
??is validatorius turi u??fiksuoti, kad ??ie inputai n??ra valid??s:
- "q:3,2:2,5:1"
- "-:3,2:2,5:1"
- "3,2:2,5:1"
Kai u??fiksuojamas nevalidus inputas, programa turi ?? komandin?? eilut?? i??spausdinti ???? prane??im??:
Invalid input "3,2:2,5:1". Format: id:quantity,id:quantity
Klaidingo inputo atveju ?? log'?? ra??yti prane??imo nereikia.
Svarbu: Abi klas??s (inventoriy checkeris ir input validatorius) turi b??ti kvie??iami tame pa??iame "try" bloke.
Naudokite savo custom exception'o klas?? (pvz.: InputValidationException).
Programos kvietimo pavyzdys:
php -f 2_inventory_checker.php "3,2:2,5:1"
Invalid input "3,2:2,5:1". Format: id:quantity,id:quantity
*/
