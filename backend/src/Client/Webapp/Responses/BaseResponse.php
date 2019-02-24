<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Responses;

use Silex\Application;


abstract class BaseResponse
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}