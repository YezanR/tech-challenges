<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Providers;

use Pimple\ServiceProviderInterface;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileSurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Services\BasicSurveyService;

class SurveyServiceProvider implements ServiceProviderInterface
{
    public function register(\Pimple\Container $app)
    {
        $app['survey.repository'] = function () {
            return new JsonFileSurveyRepository();
        };
        
        $app['survey.service'] = function () use ($app) {
            return new BasicSurveyService($app['survey.repository']);
        };
    }    
}