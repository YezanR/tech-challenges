<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts;

use IWD\JOBINTERVIEW\Modules\Core\Repository\Contracts\Repository;

interface AnswerRepository extends Repository
{
    public function getGroupBySurvey();
}