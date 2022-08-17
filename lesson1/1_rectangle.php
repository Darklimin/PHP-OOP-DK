<?php

declare(strict_types=1);

/*
Sukurkite klasę, kuri skaičiuotų keturkampio plotą, perimetrą ir įstrižainę.
Klasės pavadinimas: Rectangle
Į konstruktorių paduodama: int $length, int $width
Metodai:
- calculateArea()
- calculatePerimeter()
- calculateDiagonal()
Metodai turi grąžinti iki 2 skaitmenų po kablelio į viršų suapvalintą float tipo reikšmę. Pridėkite return tipą metodams.
*/

class Rectangle {
    private int $length;
    private int $width;

    public function __construct (int $length, int $width){
        $this->length = $length;
        $this->width = $width;
    }

    public function calculateArea(): float {
        return round($this->length * $this->width, 2);
    }

    public function calculatePerimeter(): float {
        return round($this->length * 2 + $this->width * 2, 2);
    }

    public function calculateDiagonal(): float {
        return round(sqrt(($this->length ** 2) + ($this->width ** 2)), 2);
    }
}

$myRect = new Rectangle(5, 3);
var_dump($myRect->calculateArea());
var_dump($myRect->calculatePerimeter());
var_dump($myRect->calculateDiagonal());