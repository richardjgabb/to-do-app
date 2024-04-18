<?php
declare(strict_types=1);

use App\Controllers\CompletedController;
use App\Controllers\DeleteController;
use App\Controllers\EditController;
use App\Controllers\EditedController;
use App\Controllers\HomeActionsController;
use App\Controllers\HomeController;
use App\Controllers\MarkCompleteController;
use App\Controllers\markIncompleteController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', HomeController::class);
    $app->post('/', HomeActionsController::class);
    $app->get('/completedTasks', CompletedController::class);
    $app->get('/delete/{id}', DeleteController::class);
    $app->get('/markComplete/{id}', MarkCompleteController::class);
    $app->get('/markIncomplete/{id}', MarkIncompleteController::class);
    $app->get('/edit/{id}', EditController::class);
    $app->post('/edit/{id}', EditedController::class);
};
