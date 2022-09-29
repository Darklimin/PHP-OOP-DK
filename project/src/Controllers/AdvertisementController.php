<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Repositories\AdvertisementRepository;

class AdvertisementController
{

    public function __construct(private AdvertisementRepository $repository)
    {
    }

    public function list()
    {
        $advertisements = $this->repository->getAll();

        require 'View/Advertisements/index.php';
    }

    public function create()
    {

        require 'View/submit.php';

    }

    public function delete()
    {

        require 'View/delete.php';
    }

}