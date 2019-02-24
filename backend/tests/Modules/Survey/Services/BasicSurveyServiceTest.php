<?php

namespace IWD\TEST\Modules\Survey\Services;

use IWD\TEST\Modules\ModuleTestCase;

class BasicSurveyServiceTest extends ModuleTestCase
{
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app['survey.service'];
    }    

    /**
     * @test
     *
     * @return void
     */
    public function get()
    {
        $result = $this->service->get();
        echo "\n";
        print_r($result);
    }
}