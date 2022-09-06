<?php

declare(strict_types=1);

class SmartList
{
    public array $items = [];

    public function __get($name)
    {
        if ($name === 'size') {
            return count($this->items);
        } else {
            throw new Exception('Not a function');
        }
    }
}

/*
Magiškų metodų pagalba galime objekto savybių paėmimą padaryti dinaminį
Skaidrėse rasite magišką metodą, kuris leidžia įsiterpti kai paimama neegzistuojanti objekto savybė
Klasė turi įgauti parametrą 'size', kuris visuomet nurodo masyvo 'items' dydį
Išbandymas:*/
$sl = new SmartList();
var_dump($sl->size); // 0
$sl->items[] = 'x';
$sl->items[] = 'y';
var_dump($sl->size); // 2
//var_dump($sl->test); // klaida