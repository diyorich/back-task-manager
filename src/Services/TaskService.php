<?php

namespace App\Services;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\DBAL\Exception;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->findAll();
    }

    //TODO handle exception on duplicate insertion
    public function createTasks(array $taskData)
    {
        foreach ($taskData as $task) {
            $newTask = new Task();

            if ($this->getTask($task['title'])) {
                throw new Exception('Таск с этим именем уже существует, поменяйте название');
            }
            $newTask->setTitle($task['title']);
            $this->taskRepository->add($newTask, true);
        }
    }

    public function editTask(array $data)
    {
        $task = new Task();
        $task->setTitle($data['title']);
        $task->setId($data['id']);
        $this->taskRepository->update($task, true);
    }

    public function getTask(string $title)
    {
        return $this->taskRepository->findOneBy(["title" => $title]);
    }
}