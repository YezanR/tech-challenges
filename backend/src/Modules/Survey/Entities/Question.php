<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Entities;

class Question extends Entity   
{
    private $label;
    private $type;
    private $options;

    public function __construct(array $attributes = [])
    {
        $this->label = $attributes['label'];
        $this->type = $attributes['type'];
        $this->options = $attributes['options'];
    }

    /**
     * Get the value of label
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of options
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @return  self
     */ 
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'options' => $this->getOptions(),
            'answer' => $this->answer
        ];
    }
}