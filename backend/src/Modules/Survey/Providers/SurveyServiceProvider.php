<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Providers;

use Pimple\ServiceProviderInterface;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileSurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Services\BasicSurveyService;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileAnswerRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Services\BasicAnswerService;

class SurveyServiceProvider implements ServiceProviderInterface
{
    public function register(\Pimple\Container $app)
    {
        $app['answer.repository'] = function () {
            return new JsonFileAnswerRepository();
        };

        $app['survey.repository'] = function () use ($app) {
            return new JsonFileSurveyRepository($app['answer.repository']);
        };
        
        $app['survey.service'] = function () use ($app) {
            return new BasicSurveyService($app['survey.repository']);
        };

        $app['answer.service'] = function () use ($app) {
            return new BasicAnswerService($app['answer.repository']);
        };
    }    
}