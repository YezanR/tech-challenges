<?php

namespace IWD\JOBINTERVIEW\Modules\Survey\Repositories;

use IWD\JOBINTERVIEW\Modules\Core\Repository\JsonFileRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\Contracts\SurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Entities\Survey;
use IWD\JOBINTERVIEW\Modules\Core\Helpers\File\Directory;

class JsonFileSurveyRepository extends JsonFileRepository implements SurveyRepository
{
    protected function getEntityClass()
    {
        return Survey::class;
    }

    protected function getEntityJsonKeyName()
    {
        return 'survey';
    }

    public function get()
    {
        $items = [];

        $directory = new Directory($this->getRootDataPath());
        $directory->eachFile(function ($fileInfo) use (&$items) {
            $data = $this->parseFile($fileInfo->getFilename()); 
            $items[] = $this->arrayToEntity($data);
        });

        $items = $this->distinct($items);

        return $items;
    }


    protected function distinct(array $items)
    {
        $distinctItems = [];

        $checkedIds = [];
        foreach ($items as $item) {
            $idName = $item->getIdName();
            $id = $this->getEntityProperty($item, $idName);

            if (!in_array($id, $checkedIds)) {
                $distinctItems[] = $item;
                $checkedIds[] = $id;
            }
        }

        return $distinctItems;
    }

    public function getGroupBy(string $attribute)
    {
        $items = [];
        
        $directory = new Directory($this->getRootDataPath());
        $directory->eachFile(function ($fileInfo) use (&$items, $attribute) {
            $data = $this->parseFile($fileInfo->getFilename()); 
            $aggregate = $data['survey'][$attribute];
            $items[$aggregate] = $items[$aggregate] ?? [];
            $items[$aggregate] = array_merge($items[$aggregate], $data['questions']);
        });
        
        return $items;
    }
}