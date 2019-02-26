<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Repository;

use IWD\JOBINTERVIEW\Modules\Core\Repository\Contracts\Repository;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\Json\Parser;

abstract class JsonFileRepository implements Repository
{
    protected $rootDataPath= 'data/'; 

    abstract protected function getEntityClass();

    abstract protected function getEntityJsonKeyName();

    public function getRootDataPath()
    {
        return $this->rootDataPath;
    }

    protected function parseFile(string $filename)
    {
        $data = Parser::parseFile($this->getRootDataPath() . $filename);
        return $data;
    }

    private function getEntityProperty($entity, string $property)
    {
        $getterMethodName = 'get' . ucfirst($property);
        return call_user_func([$entity, $getterMethodName]);
    }

    protected function arrayToEntity(array $array)
    {
        $entity = null;

        $key = $this->getEntityJsonKeyName();
        $class = $this->getEntityClass();

        $entityAttributes = $array[$key] ?? null;
        if ($entityAttributes && is_array($entityAttributes)) {
            $entity = new $class($entityAttributes);
        }

        return $entity;
    }
}