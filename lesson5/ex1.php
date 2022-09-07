<?php

declare(strict_types=1);

class PassVal
{
    public static function isSet($pass): void {
        if (!isset($pass[1])) {
            throw new \Exception('Please enter password');
        }
    }

    public static function valLength(array $pass): void {
        if (strlen($pass[1])<10) {
            throw new \Exception('Password must be at least 10 symbols long');
        }
    }

    public static function valSymbols(array $pass): void {
        if (!preg_match('/[^\w]{2}/', $pass[1])) {
            throw new \Exception('Password must contain at least 2 special symbols (!@#$%^&*_)');
        }
    }

    public static function valUpper(array $pass): void {
        if (!preg_match('@[A-Z]@', $pass[1])) {
            throw new \Exception('Password must contain uppercase and lowercase letters');
        }
    }

    public static function valLower(array $pass): void {
        if (!preg_match('@[a-z]@', $pass[1])) {
            throw new \Exception('Password must contain uppercase and lowercase letters');
        }
    }

    public static function valNumbers(array $pass): void {
        if (!preg_match('@\d@', $pass[1])) {
            throw new \Exception('Password must contain at least one number');
        }
    }

    public static function valAll($pass): void {
        self::isSet($pass);
        self::valSymbols($pass);
        self::valNumbers($pass);
        self::valLength($pass);
        self::valUpper($pass);
        self::valLower($pass);
        echo 'Password is valid';
    }
}

$errors = [];

try {
    PassVal::valAll($argv);
} catch (\Exception $exception) {
    file_put_contents('./errors.txt', $exception->getMessage() . PHP_EOL, FILE_APPEND);
    echo file_get_contents('./errors.txt');
}

/*
1.1 Parašykite įrankį slaptažodžio stiprumui nustatyti.
Slaptažodis turi:
- būti sudarytas iš ne mažiau 10 simblių
- turi turėti bent 2 skirtingus specialiuosius simbolius (!@#$%^&*_)
- turi turėti ir mažųjų, ir didžiųjų raidžių (aB)
- turi turėti bent vieną skaitmenį (0-9)
Slaptažodžio validavimas turi vykti klasėje PasswordValidator.
Validatorius, atradęs taisyklės pažeidimą, turi mesti exception'ą su žinute (pvz.: "Password must be at least ten symbols long")
Kodas, kviečiantis validatorių turi gaudyti exception'ą ir spausdinti žinutę terminale.
Jeigu slaptažodis atitinka reikalavimus, spausdinkite "Password is valid"
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
php -f 1_password_validator.php 123456abc!@
Password is valid
1.2 Patobulinkite validatoriu. Validatorius turi sukaupti visas klaidas ir jas išspausdinti.
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
Password must contain at least 2 special symbols (!@#$%^&*_)
Password must contain uppercase and lowercase letters
*/
