<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Services;

use IWD\JOBINTERVIEW\Modules\Survey\Services\Contracts\SurveyService;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;

class BasicSurveyService implements SurveyService
{
    private $survey;

    public function __construct(SurveyRepository $survey)
    {
        $this->survey = $survey;
    }

    public function get()
    {
        return $this->survey->get();
    }    

    public function getAnswers()
    {
        $groupedSurveys = $this->survey->getGroupBy('code');

        foreach ($groupedSurveys as $code => $questions) {
            $groupedSurveys[$code] = $this->aggregateQuestionsByLabel($questions);
        }
        
        return $groupedSurveys;
    }

    protected function aggregateQuestionsByLabel(array $questions)
    {
        $groupedAnswers = [];
        foreach ($questions as $question) {
            $label = $question['label'];
            $type = $question['type'];
            switch ($type) {
                case 'numeric':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? 0;
                    $groupedAnswers[$label] += $question['answer'];
                break;
                case 'date':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? [];
                    $groupedAnswers[$label][] = $question['answer'];
                break;
                case 'qcm':
                    $groupedAnswers[$label] = $groupedAnswers[$label] ?? [];
                    $options = $question['options'];
                    $answers = $question['answer'];
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