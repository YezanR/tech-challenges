<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Repository;

use IWD\JOBINTERVIEW\Modules\Core\Repository\Contracts\Repository;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\Json\Parser;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\Entity\Traits\CreatesEntity;

abstract class JsonFileRepository implements Repository
{
    use CreatesEntity;
    
    protected $rootDataPath= 'data/'; 

    public function getRootDataPath()
    {
        return $this->rootDataPath;
    }

    protected function parseFile(string $filename)
    {
        $data = Parser::parseFile($this->getRootDataPath() . $filename);
        return $data;
    }
}