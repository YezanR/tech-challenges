<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Entities\Contracts;

interface Identifiable
{
    /**
     * Get identifier name
     *
     * @return string
     */
    public function getIdName() : string;
}