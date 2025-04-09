<?php

namespace App\Services\Impl;

use App\Container;
use App\Repository\UserRepository;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    function getUsers(): array
    {
        return $this->userRepository->getUsers();
    }
}