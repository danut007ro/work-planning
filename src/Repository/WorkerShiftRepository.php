<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\WorkerShift;
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

    // /**
    //  * @return WorkerShift[] Returns an array of WorkerShift objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkerShift
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
