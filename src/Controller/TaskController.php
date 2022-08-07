<?php

namespace App\Controller;

use App\Services\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public function __construct(private TaskService $taskService)
    {
    }

    #[Route('task/get-all')]
    public function getAllTasks(): Response
    {
        $allTasks = $this->taskService->getAllTasks();
        return $this->json($allTasks);
    }

    #[Route('task/create')]
    public function createTask(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $this->taskService->createTasks($data);
        return $this->json(["message" => "Таск создан"]);
    }
}