<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Helpers\Entity\Traits;

trait CreatesEntity
{
    public function createEntity(string $class, array $attributes)
    {
        return new $class($attributes);
    }
}