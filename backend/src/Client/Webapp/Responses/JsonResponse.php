<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Responses;

use IWD\JOBINTERVIEW\Client\Webapp\Responses\Contracts\AppResponse;
use IWD\JOBINTERVIEW\Client\Webapp\Responses\BaseResponse;

class JsonResponse extends BaseResponse implements AppResponse
{
    public function respondWithSuccess($data, int $status = 200)
    {
        return $this->app->json($data, $status);
    }   
    
    public function respondWithError($error, int $status)
    {
        return $this->app->json($error, $status);
    }
}