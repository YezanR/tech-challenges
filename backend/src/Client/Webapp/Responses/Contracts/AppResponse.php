<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Responses\Contracts;

interface AppResponse
{
    public function respondWithError($data, int $status);

    public function respondWithSuccess($data, int $status = 200);
}