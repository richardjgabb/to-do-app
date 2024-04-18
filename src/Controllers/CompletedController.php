<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class CompletedController
{
    private TaskModel $model;
    private PhpRenderer $renderer;
    public function __construct(TaskModel $model, PhpRenderer $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $tasks = $this->model->getCompletedTasks();
        return $this->renderer->render($response, 'completedTasks.phtml', ['completedTasks'=>$tasks]);
    }
}