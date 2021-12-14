<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\WorkerShift;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteWorkerShifts extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    #[Route('/worker-shifts/{id}', name: 'delete_worker_shifts', methods: ['DELETE'])]
    public function __invoke(WorkerShift $workerShift): Response
    {
        $this->em->remove($workerShift);
        $this->em->flush();

        return $this->json([]);
    }
}
