<?php

namespace App\Controllers;

use App\App;
use App\Exceptions\EntryNotFoundException;
use App\Services\UserService;

class UserController
{
    public function getUsers(): array
    {
        try {
            $res = App::$container->get(UserService::class)->getUsers();
        } catch (EntryNotFoundException $e) {
            echo $e->getMessage();
        }
        return $res;
    }
}