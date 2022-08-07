<?php

namespace App\Services;

use App\Entity\Task;
use App\Repository\TaskRepository;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->findAll();
    }

    public function createTask($title)
    {
        $task = new Task();
        $task->setTitle($title);

        $this->taskRepository->add($task);
    }
}