<?php

namespace App\Repository;

class CardRepository
{
    private array $cards = ["card1", "card2", "card3"];
    public function getCards()
    {
        return $this->cards;
    }
}