<?php

namespace App;

use App\Exceptions\ContainerException;
use App\Exceptions\EntryNotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionException;

class Container implements ContainerInterface
{
    private array $entries = [];

    /**
     * @param string $id
     * @throws ContainerException
     * @throws EntryNotFoundException
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        if($this->has($id)){
            $entry = $this->entries[$id];
            if(is_callable($entry)){
                return $entry($this);
            }
            $id = $entry;
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    //za sada samo za konkretne klase

    /**
     * @throws ReflectionException
     * @throws ContainerException
     * @throws EntryNotFoundException
     */
    private function resolve(string $id)
    {
        $reflection = new \ReflectionClass($id);
        if(!$reflection->isInstantiable()){
            throw new ContainerException("No support for interfaces.");
        }

        $constructor = $reflection->getConstructor();
        if(! $constructor){
            return new $id;
        }

        $parameters = $constructor->getParameters();
        if(! $parameters){
            return  new $id;
        }

        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            if(! $type){
                throw new ContainerException("Type not hinted for " . $name . " dependency in " . $id);
            }

            if($type instanceof \ReflectionUnionType){
                throw new ContainerException("No support for union types: " . $name);
            }
            if(! ($type instanceof \ReflectionNamedType)){
                throw new ContainerException("Dependency is not of ReflectionNamedType: " . $name);
            }
            if($type->isBuiltin()){
                //posle treba isfiltrirati za null vrednosti, jer ove preskacemo
                return null;
            }
            return $this->get($type->getName());


        }, $parameters);

        $resolvedDependencies = array_filter($dependencies);

        return $reflection->newInstanceArgs($resolvedDependencies);

    }


    /**
     * @param string $id
     * @param callable $concrete: Factory function that will provide us
     * with the concrete implementation of the specified $id class.
     * @return void
     */
    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }
}