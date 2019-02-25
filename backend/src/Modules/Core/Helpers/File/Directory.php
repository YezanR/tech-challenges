<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Helpers\File;

use DirectoryIterator;

use Closure;

class Directory
{
    protected $path;

    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    public function eachFile(Closure $callback)
    {
        $directory = new DirectoryIterator($this->getPath());

        foreach ($directory as $fileInfo) {
            if (!$fileInfo->isDot()) {
                call_user_func($callback, $fileInfo);
            }
        }
    }

    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        if (!file_exists($path)) {
            throw new Excepeption("Directory '$path' doesn't exist!");
        }
        else {
            $this->path = $path;
            return $this;
        }
    }
}