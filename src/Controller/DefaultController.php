<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private BookRepository $bookRepository, private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/newBook')]
    public function addNewBook(): Response
    {
        $book = new Book();
        $book->setTitle('Чёрт на куличиках');

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return new Response();
    }

    #[Route('/')]
    public function root(): Response
    {
        $books = $this->bookRepository->findAll();

        return $this->json($books);
    }
}
