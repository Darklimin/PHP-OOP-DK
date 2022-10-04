<?php

declare(strict_types=1);

namespace DariusKliminskas\Pretest\Controllers;

use DariusKliminskas\Pretest\Models\DataToFile;

class ShopController
{

    public function __construct(private DataToFile $dtf)
    {
    }

    public function putData()
    {
        $products = $this->dtf->toFile();
        $products = $this->dtf->fromFile();

        require 'view/Shop/index.php';
    }

    public function deleteData()
    {
        $this->dtf->deleteProduct();
        $products = $this->dtf->fromFile();
        require 'view/Shop/index.php';
    }

    public function list(): void
    {
        $products = $this->dtf->deleteList();

        require 'view/Shop/index.php';
    }

    public function sumData()
    {
        $products = $this->dtf->fromFile();
        $outputSum = $this->dtf->returnSum();

        require 'view/Shop/index.php';
    }

    public function useDiscount()
    {
        $products = $this->dtf->fromFile();
        $outputSum = $this->dtf->returnSum();
        $finalSum = $this->dtf->addDiscount();

        require 'view/Shop/index.php';
    }

}