<?php

namespace App;

use App\Repository\CardRepository;
use App\Repository\UserRepository;
use App\Services\CardService;
use App\Services\Impl\CardServiceImpl;
use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;

class App
{
    public static Container $container;

    public function __construct()
    {
        static::$container = new Container();

        static::$container->set(CardService::class, CardServiceImpl::class);
        static::$container->set(UserRepository::class, fn() => new UserRepository());
//        static::$container->set(CardRepository::class, fn() => new CardRepository());

        static::$container->set(UserService::class, function (Container $c){
            return new UserServiceImpl($c->get(UserRepository::class));
        });
//        static::$container->set(CardService::class, function (Container $c){
//            return new CardServiceImpl($c->get(CardRepository::class));
//        });
    }



}