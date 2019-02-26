<?php

$app->get('/', function () use ($app) {
    return 'Status OK';
});

$app->get('/surveys', 'survey.controller:index');

$app->get('/answers', 'answer.controller:get');