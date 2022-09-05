<?php

declare(strict_types=1);

class Person
{
    public string $name;
    public string $surname;

    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function __toString (): string {
        return 'This person is called ' . $this->name . ' ' . $this->surname;
    }
}

/*
Paredaguokite klasę Person, kad veiktų šis kodas:
$person = new Person('John', 'Smith');
echo $person; // "This person is called John Smith"
*/

$person = new Person('John', 'Smith');
echo $person; // "This person is called John Smith"
