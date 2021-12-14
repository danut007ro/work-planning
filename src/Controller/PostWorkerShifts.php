<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\WorkerShift;
use App\Form\PostWorkerShiftsType;
use App\Request\PostWorkerShiftsRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostWorkerShifts extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private NormalizerInterface $normalizer,
        private ValidatorInterface $validator,
    ) {
    }

    #[Route('/worker-shifts', name: 'post_worker_shifts', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        /** @var mixed[] $json */
        $json = json_decode($request->getContent(), true) ?? [];

        // Create form and validate request.
        $form = $this->createForm(PostWorkerShiftsType::class);
        if (!$form->submit($json)->isValid()) {
            return $this->json($this->normalizer->normalize($form), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var PostWorkerShiftsRequest $data */
        $data = $form->getData();
        /** @var \DateTimeInterface $date */
        $date = $data->date;

        $workerShift = (new WorkerShift())
            ->setWorker($data->worker)
            ->setShift($data->shift)
            ->setDate($date)
        ;

        // Validate input data.
        if (($violations = $this->validator->validate($workerShift))->count() > 0) {
            return $this->json($this->normalizer->normalize($violations), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->em->persist($workerShift);
        $this->em->flush();

        return $this->json(
            $this->normalizer->normalize(
                $workerShift,
                'json',
                ['groups' => 'get_worker_shifts'],
            ),
            Response::HTTP_CREATED,
        );
    }
}
