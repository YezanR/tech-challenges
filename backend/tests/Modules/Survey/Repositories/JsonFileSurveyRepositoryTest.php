<?php

namespace IWD\TESTModules\Survey\Repositories;

use PHPUnit\Framework\TestCase;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileSurveyRepository;

class JsonFileSurveyRepositoryTest extends TestCase
{
    protected $repository;

    public function setUp()
    {
        $this->repository = new JsonFileSurveyRepository();
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