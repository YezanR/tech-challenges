<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Common\Repository\JsonFileRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Survey;

class JsonFileSurveyRepository extends JsonFileRepository implements SurveyRepository
{
    protected function getEntityClass()
    {
        return Survey::class;
    }

    protected function getEntityJsonKeyName()
    {
        return 'survey';
    }

    public function get()
    {
        $result = $this->getEntities();

        return $result;
    }    
}