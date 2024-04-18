<?php

declare(strict_types=1);


namespace App\Models;


use PDO;
use Psr\Http\Message\ResponseInterface;

class TaskModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getIncompleteTasks(): array
    {
        $query = $this->db->prepare('SELECT `id`, `task`, `completed` FROM `tasks` WHERE `completed` != 1');
        $query->execute();
        return $query->fetchAll();
    }

    public function getCompletedTasks(): array
    {
        $query = $this->db->prepare('SELECT `id`, `task`, `completed` FROM `tasks` WHERE `completed` = 1');
        $query->execute();
        return $query->fetchAll();
    }

    public function addTask(string $task): void
    {
        $query = $this->db->prepare(
            'INSERT INTO `tasks` (`task`)
                   VALUES (:task)');
        $query->bindParam(':task', $task);
        $query->execute();
    }

    public function deleteTask(int $id): void
    {
        $query = $this->db->prepare(
            'DELETE FROM `tasks` WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function markAsCompleted(int $id): void
    {
        $query = $this->db->prepare(
            'UPDATE `tasks` SET `completed` = 1 WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function markIncomplete(int $id): void
    {
        $query = $this->db->prepare(
            'UPDATE `tasks` SET `completed` = 0 WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function getTaskById(int $id)
    {
        $query = $this->db->prepare('SELECT `id`, `task`, `completed` FROM `tasks` WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function editTask(string $task, int $id): void
    {
        $query = $this->db->prepare(
            'UPDATE `tasks` SET `task` = :task WHERE `id` = :id');
        $query->bindParam(':task', $task);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}