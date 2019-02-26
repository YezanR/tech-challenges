<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Core\Repository\JsonFileRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Survey;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\AnswerRepository;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\Entity\Traits\CreatesEntity;

class JsonFileSurveyRepository extends JsonFileRepository implements SurveyRepository
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function get()
    {
        $surveys = [];

        $surveysAnswers = $this->answerRepository->get();

        $surveys = array_column($surveysAnswers, 'survey');

        $surveys = $this->distinct($surveys);

        return $surveys;
    }

    protected function distinct(array $items)
    {
        $distinctItems = [];

        $checkedIds = [];
        foreach ($items as $item) {
            $id = $item->getId();

            if (!in_array($id, $checkedIds)) {
                $distinctItems[] = $item;
                $checkedIds[] = $id;
            }
        }

        return $distinctItems;
    }
}