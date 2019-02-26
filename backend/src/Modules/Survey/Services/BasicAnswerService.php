<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Services;

use IWD\JOBINTERVIEW\Modules\Survey\Services\Contracts\AnswerService;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\AnswerRepository;

class BasicAnswerService implements AnswerService
{
    protected $answers;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answers = $answerRepository;
    }

    public function get()
    {
        $items = [];

        $groupedAnswers = $this->answers->getGroupBySurvey();

        foreach ($groupedAnswers as $code => $questions) {
            $items[$code] = $this->aggregateAnswersByQuestion($questions);
        }
        
        return $items;
    }

    protected function aggregateAnswersByQuestion(array $questions)
    {
        $groupedAnswers = [];

        foreach ($questions as $question) {
            $label = $question->getLabel();
            $type = $question->getType();
            switch ($type) {
                case 'numeric':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? 0;
                    $groupedAnswers[$label] += $question->answer;
                break;
                case 'date':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? [];
                    $groupedAnswers[$label][] = $question->answer;
                break;
                case 'qcm':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? [];
                    $options = $question->getOptions();
                    $answers = $question->answer;
                    foreach ($options as $key => $option) {
                        $groupedAnswers[$label][$option] = $groupedAnswers[$label][$option] ?? 0;
                        $groupedAnswers[$label][$option] += ($answers[$key] == true ? 1:0); 
                    }
                break;
            }
        }

        return $groupedAnswers;
    }
}