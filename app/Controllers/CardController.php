<?php

namespace App\Controllers;
use App\App;
use App\Exceptions\ContainerException;
use App\Exceptions\EntryNotFoundException;
use App\Services\CardService;

class CardController
{
    public function __construct()
    {
    }

    public function getCards(): array
    {
        try {
            $res = App::$container->get(CardService::class)->getCards();
        } catch (EntryNotFoundException|ContainerException|\ReflectionException $e) {
            echo $e->getMessage();
        }
        return $res;
    }
}