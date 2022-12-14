<?php

declare(strict_types=1);

class BankAccount
{
    protected int $balance;

    public function __construct(int $balance = 0)
    {
        if ($balance < 0) {
            $this->balance = 0;
            die('Balance cannot be less than 0');
        }
        $this->balance = $balance;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function spend(int $amount): void
    {
        if ($amount > $this->balance) {
            die('Cannot spend more than you have');
        }

        if ($amount <= 0) {
            die('Can only spend a positive amount');
        }

        $this->balance = $this->balance - $amount;
    }

    public function deposit(int $amount): void
    {
        $amount = $this->applyFees($amount);

        if ($amount > 0) {
            $this->balance = $this->balance + $amount;
        }
    }

    protected function applyFees(int $amount): int
    {
        return (int) round($amount - $amount * 0.01);
    }
}

class StudentAccount extends BankAccount
{
    public function deposit(int $amount): void
    {
        if ($amount > 0) {
            $this->balance = $this->balance + $amount;
        }
    }
}

class ChildAccount extends BankAccount
{
    public function spend(int $amount): void
    {
        if ($amount > $this->balance) {
            die('Cannot spend more than you have');
        }

        if ($amount <= 0) {
            die('Can only spend a positive amount');
        }

        if ($amount >= 10) {
            die('Max sum (10 eur) exceeded');
        }

        $this->balance = $this->balance - $amount;
    }
}

class CreditAccount extends BankAccount
{
    protected int $maxCreditAmount;

    public function __construct(int $balance = 0, int $maxCreditAmount = 0)
    {
        if ($balance < 0 - $maxCreditAmount) {
            $this->balance = 0;
            die('Balance cannot be less than -' . $maxCreditAmount);
        }

        $this->balance = $balance;
        $this->maxCreditAmount = $maxCreditAmount;
    }

    public function spend(int $amount): void
    {
        if ($amount > $this->balance + $this->maxCreditAmount) {
            die('Cannot spend more than you have or your credit');
        }

        if ($amount <= 0) {
            die('Can only spend a positive amount');
        }

        $this->balance = $this->balance - $amount;
    }

}

class SavingsAccount extends BankAccount
{
    public function addInterest (float $interest): int {
        $this->balance += (int)round($this->balance * $interest, 0);

        return $this->balance;
    }
}

$account = new BankAccount(1000);
$account->deposit(1000);
echo $account->getBalance();
$studentAccount = new StudentAccount(1000);
$studentAccount->deposit(1000);
echo PHP_EOL . $studentAccount->getBalance() . PHP_EOL;
$childAccount = new ChildAccount(1000);
$account->spend(15);
echo $account->getBalance() . PHP_EOL;
$childAccount->spend(9);
echo $childAccount->getBalance() . PHP_EOL;
$creditAccount = new CreditAccount(1000, 100);
$creditAccount->spend(1050);
echo $creditAccount->getBalance() . PHP_EOL;
$savingsAccount = new SavingsAccount(1000);
echo $savingsAccount->getBalance() . PHP_EOL;
$savingsAccount->addInterest(0.05);
echo $savingsAccount->getBalance();

/*
Sukurkite i??vestines klases, kurios paveld??t?? klas?? BankAccount:
- klas?? StudentAccount - ??i klas?? turi netaikyti joki?? mokes??i?? depozitams.
- klas?? ChildAccount - ??i klas?? neturi leisti per vien?? kart?? i??leisti daugiau nei 10eur.
- klas?? CreditAccount - ??i klas?? turi leisti balansui nukristi iki -X sumos ($maxCreditAmount).
T.y. balansas gali buti neigiamas. $maxCreditAmount yra teigiama integer tipo reik??m??.
Jeigu $maxCreditAmount yra 100, tai rei??kia, kad balansas negali kristi ??emiau -100.
??i suma ($maxCreditAmount) turi b??ti paduodama per konstruktori??.
Pavyzdys:
$account = new CreditAccount(1000, 100);
- klas?? SavingsAccount. ??i klas?? turi suteikti galimyb?? padidinti s??skaitos balans?? tam tikru procentu.
T.y. - ji gali tur??ti public metod?? 'addInterest', kur?? i??kvietus su X procentu (pvz.: 0.05), balansas padid??t?? tuo procentu
??sivaizduokite, kad ??is metodas b??t?? kvie??iamas kas metus ir s??skaita tokiu b??du augt??.
Prie balanso pridedamas pal??kanas verskite ?? int tip??.
Pavyzdys:
$account = new SavingsAccount(1000);
$account->addInterest(0.05);
*/
