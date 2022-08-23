<?php

declare(strict_types=1);

/*
Sukurkite paprastą todo aplikaciją. Naudokite objektinį programavimą. Aplikacija turi turėti 3 funkcijas:
- add - pridėti naują todo
- list - atvaizduoti visus todo
- complete - pažymėti kažkurį todo kaip padarytą. Padarytus todo galima arba trinti, arba pridėti požymį "completed"
Aplikacijos kvietimo pavyzdžiai:
------------------------------------------------------------------------
php -f todo.php add "nuplauti automobilų" "2022-03-29 15:00"
todo added!
------------------------------------------------------------------------
php -f todo.php list
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
php -f todo.php add "apsilankymas pas kirpeją" "2022-04-15 12:00"
todo added!
------------------------------------------------------------------------
php -f todo.php list
****
id: 1
nuplauti automobilų
2022-03-29 15:00
****
id: 2
apsilankymas pas kirpeją
2022-04-15 12:00
------------------------------------------------------------------------
php -f todo.php complete 1
todo completed!
------------------------------------------------------------------------
*/

class TodoUtility
{
    public function add(array $arguments): void
    {
        if ($arguments[1] === 'add') {
            $data = file_get_contents('./data.json');
            $deserializedData = json_decode($data, true);
            $deserializedData[] = [$arguments[2], $arguments[3]];
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
            echo 'todo added!';
        }
    }

    public function list(array $arg): void
    {
        if ($arg[1] === 'list') {
            $data = file_get_contents('./data.json');
            $deserializedData = json_decode($data, true);
            foreach ($deserializedData as $key => $value) {
                echo '****' . PHP_EOL . 'id: ' . $key + 1 . PHP_EOL . $value[0] .
                    PHP_EOL . $value[1] . PHP_EOL;
            }
        }
    }

    public function completed(array $argu): void
    {
        if ($argu[1] === 'complete') {
            $data = file_get_contents('./data.json');
            $deserializedData = json_decode($data, true);
            foreach ($deserializedData as $key => $value) {
                if ($key === $argu[2] - 1) {
                    unset($deserializedData[$key]);
                    echo 'todo completed!';
                }
            }
            $serializedData = json_encode($deserializedData, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
        }
    }

}

$todo = new TodoUtility();
$todo->add($argv);
$todo->list($argv);
$todo->completed($argv);