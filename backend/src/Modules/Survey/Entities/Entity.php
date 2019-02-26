<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Entities;

abstract class Entity implements \JsonSerializable
{
    public function getProperty(string $property)
    {
        $getterMethodName = 'get' . ucfirst($property);
        return call_user_func([$this, $getterMethodName]);
    }
}