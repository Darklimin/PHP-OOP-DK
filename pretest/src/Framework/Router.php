<?php

declare(strict_types=1);

namespace DariusKliminskas\Pretest\Framework;

use DariusKliminskas\Pretest\Controllers\ShopController;
use DariusKliminskas\Pretest\Framework\DIContainer;
use DariusKliminskas\Pretest\Models\TestClass;

class Router
{
    public function __construct(private DIContainer $di)
    {
    }

    public function enterData(): void {

        $controller = $this->di->get(ShopController::class);
        $controller->list();
    }
}