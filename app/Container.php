<?php

namespace App;

use App\Exceptions\EntryNotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    /**
     * @throws EntryNotFoundException
     */
    public function get(string $id)
    {
        if(!array_key_exists($id, $this->entries)){
            throw new EntryNotFoundException("Entry not found: $id.");
        }

        $entry = $this->entries[$id];
        return $entry($this);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }


    /**
     * @param string $id
     * @param callable $concrete: Factory function that will provide us
     * with the concrete implementation of the specified $id class.
     * @return void
     */
    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }
}