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
use IWD\JOBINTERVIEW\Modules\Survey\Providers\SurveyServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use IWD\JOBINTERVIEW\Client\Webapp\Responses\JsonResponse;
use IWD\JOBINTERVIEW\Modules\Survey\Providers\ControllerServiceProvider;

$app = new Application();
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});

// @todo create a service provider for response (be carefull, you gonna need to have Silex\Application injected)
$app['web.response'] = function () use ($app) {
    return new JsonResponse($app);
};

$app->get('/', function () use ($app) {
    return 'Status OK';
});

$app->get('/surveys', 'survey.controller:index');

$app->get('/answers', 'answer.controller:get');

$app->register(new SurveyServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new ControllerServiceProvider());

$app->run();

return $app;
