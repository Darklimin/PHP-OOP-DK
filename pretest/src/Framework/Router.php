<?php

declare(strict_types=1);

namespace DariusKliminskas\Pretest\Framework;

use DariusKliminskas\Pretest\Controllers\ShopController;

class Router
{
    public function __construct(private DIContainer $di)
    {
    }

    public function process(string $method): void
    {
        $controller = $this->di->get(ShopController::class);
        if ($method == 'POST') {
            $controller->putData();
        } elseif ($method == 'DELETE') {
            $controller->deleteData();
        } elseif ($method == 'SUM') {
            $controller->sumData();
        } elseif ($method == 'DISCOUNT') {
            $controller->useDiscount();
        } else
            $controller->list();
    }
}