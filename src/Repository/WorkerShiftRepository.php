<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\WorkerShift;
use App\Request\GetWorkerShiftsRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkerShift>
 *
 * @method null|WorkerShift find($id, $lockMode = null, $lockVersion = null)
 * @method null|WorkerShift findOneBy(array $criteria, array $orderBy = null)
 * @method WorkerShift[]    findAll()
 * @method WorkerShift[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerShiftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkerShift::class);
    }

    /**
     * @return WorkerShift[]
     */
    public function findByGetWorkerShiftRequest(GetWorkerShiftsRequest $request): array
    {
        $criteria = [];
        if (null !== $request->worker) {
            $criteria['worker'] = $request->worker;
        }
        if (null !== $request->date) {
            $criteria['date'] = $request->date;
        }

        return $this->findBy($criteria);
    }
}
