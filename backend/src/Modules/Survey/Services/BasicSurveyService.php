<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Services;

use IWD\JOBINTERVIEW\Modules\Survey\Services\Contracts\SurveyService;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;

class BasicSurveyService implements SurveyService
{
    private $survey;

    public function __construct(SurveyRepository $survey)
    {
        $this->survey = $survey;
    }

    public function get()
    {
        return $this->survey->get();
    } 
}