<?php

namespace IWD\JOBINTERVIEW\Modules\Common\Repository;

abstract class JsonFileRepository
{
    protected $rootDataPath= 'data/'; 

    public function getRootDataPath()
    {
        return $this->rootDataPath;
    }

    public function parseFile(string $filename)
    {
        $content = file_get_contents($this->getRootDataPath() . $filename);
        $data = json_decode($content, true);

        return $data;
    }

    protected function getEntities()
    {
        $entities = [];

        $directory = new \DirectoryIterator($this->getRootDataPath());

        foreach ($directory as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $data = $this->parseFile($fileInfo->getFilename());
                $entities[] = $this->arrayToEntity($data);
            }
        }

        return $entities;
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

    abstract protected function getEntityClass();

    abstract protected function getEntityJsonKeyName();
}