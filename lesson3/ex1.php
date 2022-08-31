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

/*
Sukurkite išvestines klases, kurios paveldėtų klasę BankAccount:
- klasė StudentAccount - Ši klasė turi netaikyti jokių mokesčių depozitams.
- klasė ChildAccount - Ši klasė neturi leisti per vieną kartą išleisti daugiau nei 10eur.
- klasė CreditAccount - Ši klasė turi leisti balansui nukristi iki -X sumos ($maxCreditAmount).
T.y. balansas gali buti neigiamas. $maxCreditAmount yra teigiama integer tipo reikšmė.
Jeigu $maxCreditAmount yra 100, tai reiškia, kad balansas negali kristi žemiau -100.
Ši suma ($maxCreditAmount) turi būti paduodama per konstruktorių.
Pavyzdys:
$account = new CreditAccount(1000, 100);
- klasė SavingsAccount. Ši klasė turi suteikti galimybę padidinti sąskaitos balansą tam tikru procentu.
T.y. - ji gali turėti public metodą 'addInterest', kurį iškvietus su X procentu (pvz.: 0.05), balansas padidėtų tuo procentu
Įsivaizduokite, kad šis metodas būtų kviečiamas kas metus ir sąskaita tokiu būdu augtų.
Prie balanso pridedamas palūkanas verskite į int tipą.
Pavyzdys:
$account = new SavingsAccount(1000);
$account->addInterest(0.05);
*/
