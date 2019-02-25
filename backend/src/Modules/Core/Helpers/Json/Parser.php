<?php

namespace IWD\JOBINTERVIEW\Modules\Core\Helpers\Json;

class Parser
{
    public static function parseFile(string $path)
    {
        $content = file_get_contents($path);
        $data = json_decode($content, true);

        return $data;
    }
}