<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class EditController
{
    private TaskModel $model;
    private PhpRenderer $renderer;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(TaskModel $model, PhpRenderer $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $task = $this->model->getTaskById(intval($args['id']));
        return $this->renderer->render($response, 'edit.phtml', ['task'=>$task]);
    }
}