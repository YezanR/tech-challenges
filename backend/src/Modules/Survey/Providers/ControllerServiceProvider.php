<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Providers;

use Pimple\ServiceProviderInterface;
use IWD\JOBINTERVIEW\Modules\Survey\Http\Controllers\SurveyController;
use IWD\JOBINTERVIEW\Modules\Survey\Http\Controllers\AnswerController;

class ControllerServiceProvider implements ServiceProviderInterface
{
    public function register(\Pimple\Container $app)
    {
        $app['survey.controller'] = function () use ($app) {
            return new SurveyController($app['survey.service'], $app['web.response']);
        };
        
        $app['answer.controller'] = function () use ($app) {
            return new AnswerController($app['answer.service'], $app['web.response']);
        };
    }    
}