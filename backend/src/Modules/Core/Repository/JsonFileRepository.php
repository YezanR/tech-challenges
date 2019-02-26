<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Repository;

use IWD\JOBINTERVIEW\Modules\Core\Repository\Contracts\Repository;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\Json\Parser;

abstract class JsonFileRepository implements Repository
{
    protected $rootDataPath= 'data/'; 

    abstract protected function getEntityClass();

    public function getRootDataPath()
    {
        return $this->rootDataPath;
    }

    protected function parseFile(string $filename)
    {
        $data = Parser::parseFile($this->getRootDataPath() . $filename);
        return $data;
    }

    public function createEntity(array $attributes)
    {
        $class = $this->getEntityClass();
        return new $class($attributes);
    }
}