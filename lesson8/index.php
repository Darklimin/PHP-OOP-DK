<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $classWithoutPrefix = str_replace('MyProject\\', '', $className);
    $array = explode('\\', $classWithoutPrefix);
    $stringAgain = implode('\\', $array);
    $fileName = ".\\$stringAgain.php";
    require $fileName;
});

use MyProject\Classes\DataProcessor;

include './Src/Categories.php';

$dataProcessor = new DataProcessor($categories);
try {
    $dataProcessor->process('xml', 'file');
} catch (\Exception $exception){
    echo $exception->getMessage();
}