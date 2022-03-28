<?php

namespace Salvacheung\Container\Container;

use Salvacheung\Container\Contracts\ContainerException;
use InvalidArgumentException;
use Salvacheung\Container\Contracts\Container as ContainerContract;

class Container implements ContainerContract
{
    protected static $instance;

    protected $bounds = [];

    protected $resolved = [];

    public function injection($id, $concrete)
    {
        if (!is_string($id)) {
            throw new InvalidArgumentException(sprintf(
                'The id parameter must be of type string, %s given',
                is_object($id) ? get_class($id) : gettype($id)
            ));
        }

        if (is_array($concrete) && !isset($concrete['class'])) {
            throw new ContainerException();
        }

        $this->bounds[$id] = $concrete;
    }

    public function make($name)
    {
        if(isset($this->resolved[$name])) {
            return $this->resolved[$name];
        }

        if (! $this->has($name)){
            throw new ContainerException();
        }

        $bound = $this->bounds[$name];
        $params = [];

        if(is_array($bound) && isset($bound['class'])){
            $params = $bound;
            $bound = $bound['class'];
            unset($params['class']);
        }

        $object = $this->reflector($bound, $params);

        return $this->resolved[$name] = $object;
    }

    public function reflector($concrete, array $params = [])
    {
        if ($concrete instanceof \Closure) {
            return $concrete($params);
        } elseif (is_string($concrete)) {
            $reflection = new \ReflectionClass($concrete);
            $dependencies = $this->getDependencies($reflection);

            foreach ($params as $index => $value) {
                $dependencies[$index] = $value;
            }

            return $reflection->newInstanceArgs($dependencies);
        } elseif(is_object($concrete)) {
            return $concrete;
        }

        throw new ContainerException();
    }

    private function getDependencies(\ReflectionClass $reflection)
    {
        $dependencies = [];
        $constructor = $reflection->getConstructor();

        if ($constructor !== null) {
            $parameters = $constructor->getParameters();
            $dependencies = $this->getParametersByDependencies($parameters);
        }

        return $dependencies;
    }

    /**
     *
     * @param array $dependencies
     * @return array
     * @throws ContainerException
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    private function getParametersByDependencies(array $dependencies)
    {
        $params = [];

        foreach ($dependencies as $param) {
            if ($param->getClass()) {
                $paramName = $param->getClass()->name;
                $paramObject = $this->reflector($paramName);
                $params[] = $paramObject;
            } elseif ($param->isArray()) {
                if( $param->isDefaultValueAvailable()) {
                    $params[] = $param->getDefaultValue();
                } else {
                    $params[] = [];
                }
            } elseif ($param->isCallable()) {
                if( $param->isDefaultValueAvailable()) {
                    $params[] = $param->getDefaultValue();
                } else {
                    $params[] = function ($arg) {};
                }
            } else {
                if($param->isDefaultValueAvailable()) {
                    $params[] = $param->getDefaultValue();
                } else {
                    if ($param->allowNull()) {
                        $params[] = null;
                    } else {
                        $params[] = false;
                    }
                }
            }
        }

        return $params;
    }

    /**
     *
     * @param string $id
     * @return bool
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function has(string $id): bool
    {
        return $this->bound($id);
    }

    public function bound($id)
    {
        return isset($this->bounds[$id]);
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)){
            static::$instance = new static;
        }

        return static::$instance;
    }

    public static function setInstance(ContainerContract $container = null)
    {
        return static::$instance = $container;
    }

    /**
     *
     * @param string $id
     * @return mixed
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new ContainerException();
        }

        return $this->make($id);
    }
}