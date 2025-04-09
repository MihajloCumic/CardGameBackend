<?php

namespace App\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class EntryNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}