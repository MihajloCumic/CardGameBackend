<?php

namespace App;

class App
{
    private static Container $container;

    public function __construct()
    {
        static::$container = new Container();
    }

}