<?php
namespace eva\core;

class Container
{
    private $components = array();

    public function register($name, $params)
    {
        $className = $params['class'];
        $reflector = new \ReflectionClass($className);
        // 检查类是否可实例化
        if (!$reflector->isInstantiable())
        {
            throw new \Exception($reflector->name . '无法实例化');
        }
        $constructor = $reflector->getConstructor();
        // 若无构造函数，直接实例化并返回
        if (is_null($constructor))
        {
            $classObj = new $className;
        }
        else
        {
            $parameters = $constructor->getParameters();
            $dependencies = array();
            foreach ($parameters as $parameter)
            {
                $name = $parameter->getName();
                if (isset($params[$name]))
                {
                    $dependencies[] = $params[$name];
                    unset($params[$name]);
                }
                else
                {
                    if ($parameter->isDefaultValueAvailable())
                    {
                        $dependencies[] = $parameter->getDefaultValue();
                    }
                }
            }
            $classObj = $reflector->newInstanceArgs($dependencies);

        }
        // 获取类公共参数
        $properties = $reflector->getProperties();
        if ($properties)
        {
            foreach ($properties as $property)
            {
                $propertyName = $property->name;
                if ($property->isPublic() && isset($params[$propertyName]))
                {
                    $property->setValue($classObj, $params[$propertyName]);
                }
            }
        }
        $this->components[$name] = $classObj;
    }

    public function __get($name)
    {
        if ($this->components[$name])
        {
            return $this->components[$name];
        }
        return null;
    }
}