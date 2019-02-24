<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Repository;

use IWD\JOBINTERVIEW\Modules\Core\Repository\Contracts\Repository;

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
        $content = file_get_contents($this->getRootDataPath() . $filename);
        $data = json_decode($content, true);

        return $data;
    }

    public function get()
    {
        $items = [];

        $directory = new \DirectoryIterator($this->getRootDataPath());

        foreach ($directory as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $data = $this->parseFile($fileInfo->getFilename());
                $items[] = $this->arrayToEntity($data);
            }
        }

        return $items;
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