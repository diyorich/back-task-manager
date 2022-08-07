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

    public function createTasks(array $taskData)
    {
        foreach ($taskData as $task) {
            $newTask = new Task();
            $newTask->setTitle($task['title']);
            $this->taskRepository->add($newTask, true);
        }
    }
}