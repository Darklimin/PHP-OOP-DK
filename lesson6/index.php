<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    if ($className === 'MyProject\Service\InputValidator') {
        require './src/Service/InputValidator.php';
    }
    if ($className === 'MyProject\Service\InventoryCheck') {
        require './src/Service/InventoryCheck.php';
    }
    if ($className === 'MyProject\Exceptions\InventoryException') {
        require './src/Exceptions\InventoryException.php';
    }
    if ($className === 'MyProject\Exceptions\InputValidationException') {
        require './src/Exceptions\InputValidationException.php';
    }
});

use MyProject\Service\InputValidator;
use MyProject\Service\InventoryCheck;
use MyProject\Exceptions\InventoryException;
use MyProject\Exceptions\InputValidationException;

try {
    $validator = new InputValidator();
    $inventory = new InventoryCheck();
    $inventory->getInventory();
    $inventory->getCheck($argv[1]);
    $validator->getChe($argv[1]);
    $inventory->doCheck();
} catch (InputValidationException $exception) {
    echo $exception->getMessage();
} catch (InventoryException $exception) {
    echo $exception->getMessage();
    file_put_contents('./log.txt', date("Y-m-d H:i:s") . ' ' .
        $exception->getMessage() . PHP_EOL, FILE_APPEND);
}

/*
1.1 Susikurkite naują tuščią katalogą ir atsidarykite jį per kodo editorių.
Išskaidykite praeitos temos "inventory checker" užduotį (https://github.com/marius321967/vigi-24-oop/blob/main/l5/2_inventory_checker.php)
į atskirus failus pagal skaidrėse nurodytą failų struktūrą.
Programa turėtų būti paleidžiama iš root katalogo:
php -f index.php "1:3,2:2,5:1"
Klasės turėtų gulėt "src" kataloge:
Exceptions'ai turi gulėti "src/Exceptions" kataloge.
Kitos klasės turi gulėti "src/Service" kataloge.
Klasėms įtraukti į index.php naudokite paprastą "require"
1.2 Pridėkite namespace'sus visoms projekto klasėms
1.3 Sutvarkykite projekto autoload'inimą, pasinaudodami "spl_autoload_register" funkcija.
Programa turėtų veikti be papildomų require statementų - už visų failų įtraukimą į index.php failą turi
būti atsakingas autoloaderis
1.4 Panaudokite "use" statementus, kad nereiktų rašyti pilnai kvalifikuotų klasių pavadinimų (FQCN)
*/
