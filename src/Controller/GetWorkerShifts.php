<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Worker;
use App\Form\GetWorkerShiftsType;
use App\Repository\WorkerShiftRepository;
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

    #[Route('/worker/{id}/shifts', name: 'get_worker_shifts', methods: ['GET'])]
    public function __invoke(Worker $worker, Request $request): Response
    {
        // Create form and validate request.
        $form = $this->createForm(GetWorkerShiftsType::class);
        if (!$form->submit($request->query->all())->isValid()) {
            return $this->json($this->normalizer->normalize($form));
        }

        /** @var ?\DateTimeInterface $date */
        $date = $form['date']->getData();

        // If `date` is specified, then use it as filter.
        $findParams = ['worker' => $worker];
        if (null !== $date) {
            $findParams['date'] = $date;
        }

        return $this->json($this->normalizer->normalize(
            $this->workerShiftRepository->findBy($findParams),
            'json',
            ['groups' => 'get_worker_shifts'],
        ));
    }
}
