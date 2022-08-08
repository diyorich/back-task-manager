<?php

namespace App\Controller;

use App\Entity\Task;
use App\Services\TaskService;
use Doctrine\DBAL\Driver\Exception;
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

    #[Route('task/get-all', methods:'GET')]
    public function getAllTasks(): Response
    {
        $allTasks = $this->taskService->getAllTasks();
        return $this->json($allTasks);
    }

    #[Route('task/create', methods:'POST')]
    public function createTask(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $this->taskService->createTasks($data);
            return $this->json(["message" => "Таск создан"]);
        } catch (\Exception $exception) {
            return $this->json(["message" => $exception->getMessage()]);
        }
    }

    #[Route('task/edit/{id}', methods:'PATCH')]
    public function editTask(Request $request): JsonResponse
    {
        $route_params = $request->attributes->get('_route_params');
        $parameters['id'] = $route_params['id'];
        $parameters['title'] =  $request->query->get('title');
        $this->taskService->editTask($parameters);
        return $this->json(["message" => 'Успешно отредактировано']);
    }
}