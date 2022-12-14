<?php

declare(strict_types=1);

class KilometerConverter
{
    public function __construct(public float $input) {}

    public function convertToNauticalMiles(): float {
        return $this->input * NauticalMileConverter::NAUTICAL_MILE;
    }

    public function convertToMiles(): float {
        return $this->input * MileConverter::MILE;
    }

    public function convertToYards(): float {
        return $this->input * YardConverter::YARD;
    }

    public function convertToCentimeters(): float {
        return $this->input * CentimeterConverter::CENTIMETER;
    }

    public static function getConversionRates(): array {
        return ['nautical_mile' => round(1 / NauticalMileConverter::NAUTICAL_MILE, 3),
                'mile' => round(1 / MileConverter::MILE, 5),
                'yard' => round(1 / YardConverter::YARD, 7),
                'centimeter' => (1 / CentimeterConverter::CENTIMETER)];
    }
}

/*
1.1
Parašykite klasę KilometerConverter
Į konstruktorių turi būti paduodamas atstumas kilometrais (float).
Klasė turi turėti metodus, kuriuos būtų galima kviesti iš klasės išorės:
- convertToNauticalMiles()
- convertToMiles()
- convertToYards()
- convertToCentimeters()
Svarbu: Konvertavimo matmenys (pvz nautical mile = 1.852) turi būti saugomi klasės konstantose.
$a = new KilometerConverter(55);
echo $a->convertToCentimeters();
1.2 Klasei KilometerConverter pridėkite statinį metodą, kuris gali būti kviečiamas iš klasės išorės:
- getConversionRates(). Šis metodas turi grąžinti masyvą su visais konvertavimo matmenimis:
Šio metodo kvietimo rezultatas turetų būti:
[
    'nautical_mile' => 1.852,
    'mile' => 1.60934,
    'yard' => 0.0009144,
    'centimeter' => 1.0E-5,
]
Svarbu: naudokite klasės konstantas.
1.3
Įgyvendinkite konvertavimo logiką panaudojant abstrakčią klasę.
Sukurkite abstrakčią klasę AbstractKilometerConverter. Ši klasė turės vieną metodą: convert().
Iš šios klasės sukurkite 4 išvestines klases, kurių kiekviena implementuotų metodą convert()
ir atliktų tik tai klasei pavestą konversiją:
- NauticalMileConverter
- MileConverter
- YardConverter
- CentimeterConverter
Pavyzdys:
$centimeterConverter = new CentimeterConverter(100);
echo $centimeterConverter->convert();
*/

abstract class AbstractKilometerConverter
{
    public function __construct (public int $input) {}

    abstract public function convert(): float;
}

class NauticalMileConverter extends AbstractKilometerConverter
{
    public const NAUTICAL_MILE = 0.5399568;

    public function convert(): float
    {
        return $this->input * self::NAUTICAL_MILE;
    }
}

class MileConverter extends AbstractKilometerConverter
{
    public const MILE = 0.62137119;

    public function convert(): float
    {
        return $this->input * self::MILE;
    }
}

class YardConverter extends AbstractKilometerConverter
{
    public const YARD = 1093.6133;

    public function convert(): float
    {
        return $this->input * self::YARD;
    }
}

class CentimeterConverter extends AbstractKilometerConverter
{
    public const CENTIMETER = 100000;

    public function convert(): float
    {
        return $this->input * self::CENTIMETER;
    }
}

$a = new KilometerConverter(55);
echo $a->convertToNauticalMiles() . PHP_EOL;
echo $a->convertToMiles() . PHP_EOL;
echo $a->convertToYards() . PHP_EOL;
echo $a->convertToCentimeters() . PHP_EOL;
print_r($a->getConversionRates()) . PHP_EOL;
$nauticalMileConverter = new NauticalMileConverter(100);
$mileConverter = new MileConverter(100);
$yardConverter = new YardConverter(100);
$centimeterConverter = new CentimeterConverter(100);
echo $nauticalMileConverter->convert() . PHP_EOL . $mileConverter->convert() . PHP_EOL . $yardConverter->convert()
. PHP_EOL . $centimeterConverter->convert();