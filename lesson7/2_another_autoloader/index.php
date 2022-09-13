<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $classWithoutPrefix = str_replace('MyProject\\', '', $className);
    $array = explode('\\', $classWithoutPrefix);
    $stringAgain = implode('_', $array);
    $fileName = "C$stringAgain.php";
    $filePath = "Classes" . DIRECTORY_SEPARATOR . $fileName;
    require $filePath;
});

use MyProject\Services\AssocArrayConverter;
use MyProject\Services\InputReader;
use MyProject\Services\CarOwnershipDatabase;
use MyProject\Services\OwnershipDumper;

$converter = new AssocArrayConverter();
$reader = new InputReader();
$carOwnerContainer = $reader->readInput('./input.json');

$database = new CarOwnershipDatabase($carOwnerContainer);

$dumper = new OwnershipDumper();
$dumper->dumpOwnersAndCars($database);

/*
1.1
Programa iš .json failo nuskaito automobilių ir savininkų sąrašą, tuomet naudotojui atspausdina apdorotus duomenis.
Klasėms priskirkite Namespace. Bendras prefiksas: MyProject
Bazinius duomenis talpinančios klasės gauna namespace Models:
- Car
- Owner
Konteinerinės klasės gauna namespace Containers:
- CarOwnerContainer
Paslaugų klasės gauna namespace Services:
- CServicesInputReader
- CServicesAssocArrayConverter
- CarOwnershipDatabase
- OwnershipDumper
Pvz. FQCN klaseiInputReader: MyProject\Services\CServicesInputReader
1.2
Perkelkite visas šiame faile esančias klases į "Classes" sub-katalogą.
Kiekviena klasė laikoma savo faile.
Čia naudojamas kitoks ryšys tarp Namespace ir failų sistemos. Failo pavadinime įtraukiamas ir
klasės Namespace be projekto prefikso. Failas pradedamas raide C (t.y. class).
FQCN elementai atskiriami apatiniu brūkšniu.
Pvz.: CServices_InputReader.php
1.3
Ten, kur reikia, importuokite klases (sudėkite use raktažodžius).
1.4
Aprašykite autoloader'į šiai failų laikymo schemai išpildyti.
1.5
Daugiau užduočių...
*/
