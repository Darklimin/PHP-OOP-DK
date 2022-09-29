<?php

namespace MyProject\Framework;

use MyProject\Controllers\AdvertisementController;

class Router
{
    public function __construct(private DIContainer $di)
    {
    }

    public function process(string $url, string $method)
    {
        if (str_starts_with($url, '/')) {
            $controller = $this->di->get(AdvertisementController::class);

            if ($method == 'GET')
                $controller->list();
            if ($method == 'POST')
                $controller->create();
            if ($method == 'DELETE')
                $controller->delete();
        }
    }

}
