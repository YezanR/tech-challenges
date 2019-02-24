<?php

namespace IWD\TEST\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileSurveyRepository;
use IWD\TEST\Modules\ModuleTestCase;

class JsonFileSurveyRepositoryTest extends ModuleTestCase
{
    protected $repository;

    public function setUp()
    {
        parent::setUp();
        $this->repository = $this->app['survey.repository'];
    }

    /**
     * @test
     *
     * @return void
     */
    public function test()
    {
        $result = $this->repository->get();
        echo "\n";
        print_r($result);
    }
}