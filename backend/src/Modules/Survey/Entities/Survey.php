<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Entities;

use IWD\JOBINTERVIEW\Modules\Survey\Entities\Contracts\Identifiable;

class Survey extends Entity implements Identifiable
{
    private $name;
    
    private $code;

    public function __construct(array $attributes = [])
    {
        $this->name = $attributes['name'] ?? null;
        $this->code = $attributes['code'] ?? null;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'code' => $this->getCode()
        ];
    }

    public function getId()
    {
        return $this->code;
    }
}