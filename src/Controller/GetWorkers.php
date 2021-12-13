<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\WorkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetWorkers extends AbstractController
{
    public function __construct(
        private WorkerRepository $workerRepository,
        private NormalizerInterface $normalizer,
    ) {
    }

    #[Route('/workers', name: 'get_workers', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json($this->normalizer->normalize($this->workerRepository->findAll()));
    }
}
