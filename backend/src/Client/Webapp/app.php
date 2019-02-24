<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use IWD\JOBINTERVIEW\Modules\Survey\Repositories\JsonFileSurveyRepository;
use IWD\JOBINTERVIEW\Modules\Survey\Services\BasicSurveyService;
use IWD\TEST\Modules\Survey\Providers\SurveyServiceProvider;

$app = new Application();
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});

$app->get('/', function () use ($app) {
    return 'Status OK';
});

$app->get('/surveys', function () use ($app) {
    $surveyRepository = $app['survey.repository'];
    $items = $surveyRepository->get();
    return $items;
});

$app->register(new SurveyServiceProvider());

$app->run();

return $app;
