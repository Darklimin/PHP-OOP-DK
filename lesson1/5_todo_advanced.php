<?php

declare(strict_types=1);

/*
Pridėkite papildomo funkcionalumo todo aplikacijai iš praeitos užduoties:
- filter_by_text - filtravimas pagal todo tekstą
------------------------------------------------------------------------
php -f todo.php search "auto"
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
- filter_by_date - filtravimas pagal datą. "gt" - greater than, "lt" - less than, "eq" - lygu.
Data gali būti paduodama tik vienu formatu - "YYYY-MM-DD". Jeigu data buvo paduota kitu formatu
arba jeigu ji apskritai nėra validi, grąžinti klaidos pranešimą.
------------------------------------------------------------------------
php -f todo.php filter_by_date "gt" "2022-01-01"
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
*/
class TodoUtility
{

    public function add (array $arguments): void {
        if ($arguments[1] === 'add') {
            $data = file_get_contents('./dataadv.json');
            $deserializedData = json_decode($data, true);
            $deserializedData[] = [$arguments[2], $arguments[3]];
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./dataadv.json', $serializedData);
            echo 'todo added!';
        }
    }

    public function list (array $arg): void {
        if ($arg[1] === 'list') {
            $data = file_get_contents('./dataadv.json');
            $deserializedData = json_decode($data, true);
            foreach ($deserializedData as $key => $value) {
                echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                    PHP_EOL . $value[1] . PHP_EOL;
            }
        }
    }

    public function completed (array $argu): void {
        if ($argu[1] === 'complete') {
            $data = file_get_contents('./dataadv.json');
            $deserializedData = json_decode($data, true);
            foreach ($deserializedData as $key => $value) {
                if ($key === $argu[2] - 1) {
                    unset($deserializedData[$key]);
                    echo 'todo completed!';
                }
            }
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./dataadv.json', $serializedData);
        }
    }

    public function filter_by_text (array $arg): void {
        if ($arg[1] === 'search') {
            $data = file_get_contents('./dataadv.json');
            $deserializedData = json_decode($data, true);
            foreach ($deserializedData as $key => $value){
                if (strstr($value[0], $arg[2])){
                    echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                        PHP_EOL . $value[1] . PHP_EOL;
                }
            }
        }
    }

    private function isValid($date, $format = 'Y-m-d'): bool {
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }

    public function filter_by_date(array $arg): void
    {
        if ($arg[1] === 'filter_by_date') {
            $data = file_get_contents('./dataadv.json');
            $deserializedData = json_decode($data, true);
            if ($this->isValid($arg[3]) === false) {
                echo 'Bad date format or no date';
            } elseif ($arg[2] === 'gt') {
                foreach ($deserializedData as $key => $value) {
                    if ($value[1] > $arg[3]) {
                        echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                            PHP_EOL . $value[1] . PHP_EOL;
                    }
                }
            } elseif ($arg[2] === 'lt') {
                foreach ($deserializedData as $key => $value) {
                    if ($value[1] < $arg[3]) {
                        echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                            PHP_EOL . $value[1] . PHP_EOL;
                    }
                }
            } elseif ($arg[2] === 'eq') {
                foreach ($deserializedData as $key => $value) {
                    if ($value[1] === $arg[3]) {
                        echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                            PHP_EOL . $value[1] . PHP_EOL;
                    }
                }
            } else {
                echo 'bad command entered';
            }
        }
    }

}

$todo = new TodoUtility();
$todo->add($argv);
$todo->list($argv);
$todo->completed($argv);
$todo->filter_by_text($argv);
$todo->filter_by_date($argv);