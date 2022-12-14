<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

use Monolog\Formatter\LineFormatter;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$dateFormat = "Y-m-d H:i:s";
$output = "%message%\n";
$formatter = new LineFormatter($output, $dateFormat);
$stream = new StreamHandler(__DIR__.'/log.txt', Level::Debug);
$stream->setFormatter($formatter);
$log = new Logger('name');
$log->pushHandler($stream);

use MyProject\Service\DoCheck;
use MyProject\Service\GetCheck;
use MyProject\Service\GetInventory;
use MyProject\Containers\Container;
use MyProject\Exceptions\InventoryException;
use MyProject\Exceptions\InputValidationException;

$container = new Container();
$doCheck = $container->get(DoCheck::class);
$getCheck = $container->get(GetCheck::class);
$getInventory = $container->get(GetInventory::class);

try {
    $doCheck->doCheck($getCheck->getCheck($argv[1]), $getInventory->getInventory());
} catch (InputValidationException $exception) {
    echo $exception->getMessage();
} catch (InventoryException $exception) {
    echo $exception->getMessage();
    $log->error(date("Y-m-d H:i:s") . ' ' . $exception->getMessage());
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
