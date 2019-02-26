<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Core\Repository\JsonFileRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\AnswerRepository;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Survey;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Question;

class JsonFileAnswerRepository extends JsonFileRepository implements AnswerRepository
{
    public function get()
    {
        $items = [];

        $directory = new Directory($this->getRootDataPath());
        $directory->eachFile(function ($fileInfo) use (&$items) {
            $data = $this->parseFile($fileInfo->getFilename()); 
            
            $items[] = [
                'survey' => new Survey($data['survey']),
                'questions' => $this->createQuestionEntities($data['questions'])
            ];
        });

        return $items;
    }

    private function createQuestionEntities($questionsRaw)
    {
        $questions = [];
        foreach ($questionsRaw as $questionRaw) {
            $question = new Question($questionRaw);
            $question->answer = $questionRaw['answer'];
            $questions[] = $question;
        }

        return $questions;
    }

    public function getGroupBySurvey()
    {
        $items = [];

        $surveysAnswers = $this->get();
        foreach ($surveysAnswers as $surveyAnswers) {
            $survey = $surveyAnswers['survey'];
            $aggregate = $survey->getProperty('code');
            $items[$aggregate] = $items[$aggregate] ?? [];
            $items[$aggregate] = array_merge($items[$aggregate], $surveyAnswers['questions']);
        }

        return $items;
    }
}