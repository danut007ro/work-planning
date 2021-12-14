<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\GetWorkerShiftsType;
use App\Repository\WorkerShiftRepository;
use App\Request\GetWorkerShiftsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetWorkerShifts extends AbstractController
{
    public function __construct(
        private WorkerShiftRepository $workerShiftRepository,
        private NormalizerInterface $normalizer,
    ) {
    }

    #[Route('/worker-shifts', name: 'get_worker_shifts', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        // Create form and validate request.
        $form = $this->createForm(GetWorkerShiftsType::class);
        if (!$form->submit($request->query->all())->isValid()) {
            return $this->json($this->normalizer->normalize($form), Response::HTTP_BAD_REQUEST);
        }

        /** @var GetWorkerShiftsRequest $data */
        $data = $form->getData();

        return $this->json($this->normalizer->normalize(
            $this->workerShiftRepository->findByGetWorkerShiftRequest($data),
            'json',
            ['groups' => 'get_worker_shifts'],
        ));
    }
}
