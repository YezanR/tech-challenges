<?php

namespace IWD\TEST\Modules\Survey\Services;

use IWD\TEST\Modules\ModuleTestCase;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Survey;
use Mockery;

class BasicSurveyServiceTest extends ModuleTestCase
{
    protected $service;

    public function setUp()
    {
        parent::setUp();
    }    

    /**
     * @test
     *
     * @return void
     */
    public function get_ReturnsSurveys()
    {
        $survey = new Survey(['name' => 'Paris', 'code' => 'S1']);
        $this->app['survey.repository'] = Mockery::mock(SurveyRepository::class)
            ->shouldReceive('get')
            ->once()
            ->andReturn([$survey])
            ->getMock();
         
        $this->service = $this->app['survey.service'];

        $result = $this->service->get();
        
        $this->assertEquals([$survey], $result);
    }
}