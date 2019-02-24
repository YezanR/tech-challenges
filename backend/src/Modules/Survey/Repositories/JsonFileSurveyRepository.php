<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Core\Repository\JsonFileRepository;
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
}