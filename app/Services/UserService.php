<?php

namespace App\Services;

use App\Container;

interface UserService
{
    function getUsers(): array;
}