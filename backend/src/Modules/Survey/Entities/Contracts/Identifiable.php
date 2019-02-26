<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Entities\Contracts;

interface Identifiable
{
    /**
     * Get identifier 
     *
     * @return string
     */
    public function getId();
}