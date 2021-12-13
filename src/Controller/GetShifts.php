<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ShiftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetShifts extends AbstractController
{
    public function __construct(
        private ShiftRepository $shiftRepository,
        private NormalizerInterface $normalizer,
    ) {
    }

    #[Route('/shifts', name: 'get_shifts', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->json($this->normalizer->normalize($this->shiftRepository->findAll()));
    }
}
