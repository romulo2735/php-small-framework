<?php


namespace App\Project\DI;


class Resolver
{
    private $dependencies;

    public function method($method, array $dependencies = [])
    {
        $this->dependencies = $dependencies;

        $info = new \ReflectionFunction($method);
        $paramters = $info->getParameters();
        $paramters = $this->resolveParameters($paramters);

        return call_user_func_array($info->getClosure(), $paramters);
    }

    public function class($class, array $dependencies = [])
    {
        $this->dependencies = $dependencies;
        $class = new \ReflectionClass($class);

        if (!$class->isInstantiable()){
            throw new \Exception("{$class}class is not instaciable");
        }

        $constructor = $class->getConstructor();
        if (!$constructor){
            return new $class->name;
        }

        $paramters = $constructor->getParameters();
        $paramters = $this->resolveParameters($paramters);

        return $class->newInstanceArgs($paramters);
    }

    private function resolveParameters($paramters)
    {
        $dependecies = [];
        foreach ($paramters as $paramter){
            $dependency = $paramter->getClass();

            if ($dependency){
                $dependecies[] = $this->class($dependency->name, $this->dependencies);
            }else{
                $dependecies[] = $this->getDependencies($paramter);
            }
        }

        return $dependecies;
    }

    private function getDependencies($parameter)
    {
        if (isset($this->dependencies[$parameter->name])){
            return $this->dependencies[$parameter->name];
        }

        if ($parameter->isDefaultValueAvailable()){
            return $parameter->getDefaultvalue();
        }

        throw new \Exception("{$parameter} not recieve  a valid value");
    }
}