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

    public function get()
    {
        $items = [];

        $directory = new Directory($this->getRootDataPath());
        $directory->eachFile(function ($fileInfo) use (&$items) {
            $data = $this->parseFile($fileInfo->getFilename()); 
            $items[] = $this->arrayToEntity($data);
        });

        $items = $this->distinct($items);

        return $items;
    }

    protected function distinct(array $items)
    {
        $distinctItems = [];

        $checkedIds = [];
        foreach ($items as $item) {
            $idName = $item->getIdName();
            $id = $this->getEntityProperty($item, $idName);

            if (!in_array($id, $checkedIds)) {
                $distinctItems[] = $item;
                $checkedIds[] = $id;
            }
        }

        return $distinctItems;
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