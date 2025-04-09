<?php

namespace App\Services\Impl;

use App\Container;
use App\Repository\CardRepository;
use App\Services\CardService;

class CardServiceImpl implements CardService
{
    public function __construct(private CardRepository $cardRepository)
    {
    }

    function getCards(): array
    {
        return $this->cardRepository->getCards();
    }
}