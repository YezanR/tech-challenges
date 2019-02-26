<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Http\Controllers;

use IWD\JOBINTERVIEW\Modules\Survey\Services\Contracts\SurveyService;
use IWD\JOBINTERVIEW\Client\Webapp\Responses\Contracts\AppResponse;

class SurveyController
{
    protected $service;

    protected $response;

    public function __construct(SurveyService $surveyService, AppResponse $response)
    {
        $this->service = $surveyService;
        $this->response = $response;
    }

    public function index()
    {
        $surveys = $this->service->get();
        return $this->response->respondWithSuccess($surveys);
    }
}