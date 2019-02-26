<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Http\Controllers;

use IWD\JOBINTERVIEW\Modules\Survey\Services\Contracts\AnswerService;
use IWD\JOBINTERVIEW\Client\Webapp\Responses\Contracts\AppResponse;

class AnswerController
{
    protected $service;

    protected $response;

    public function __construct(AnswerService $answerService, AppResponse $response)
    {
        $this->service = $answerService;
        $this->response = $response;
    }

    public function get()
    {
        $surveys = $this->service->get();
        return $this->response->respondWithSuccess($surveys);
    }
}