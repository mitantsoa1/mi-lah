<?php

namespace App\Repository;

use App\Entity\Operation;
use App\Entity\Queued;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Queued>
 *
 * @method Queued|null find($id, $lockMode = null, $lockVersion = null)
 * @method Queued|null findOneBy(array $criteria, array $orderBy = null)
 * @method Queued[]    findAll()
 * @method Queued[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QueuedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Queued::class);
    }

    //    /**
    //     * @return Queued[] Returns an array of Queued objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Queued
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function getQueuedWithOperation()
    {
        $now = date("Y-m-d");
        $query =  $this->createQueryBuilder('q')
            ->innerJoin(Operation::class, 'o', 'WITH', 'q.type = o.type')
            ->where("q.createdAt LIKE '$now%'")
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $query;
    }

    public function getQueuedWithProfil($pos, $agence)
    {
        $now = date("Y-m-d");

        if ($agence == 2) {
            // Siège
            $query = $this->createQueryBuilder('q')
                ->where("q.createdAt LIKE '$now%'");
        } else {
            if ($pos == 1 || $pos == 2) {
                // Si caisse ou accueil
                $query = $this->createQueryBuilder('q')
                    ->where('q.position = :pos')
                    ->andWhere('q.agence = :agence')
                    ->andWhere("q.createdAt LIKE '$now%'")
                    ->setParameter('pos', $pos)
                    ->setParameter('agence', $agence);
            } else {
                $query = $this->createQueryBuilder('q')
                    ->where('q.agence = :agence')
                    ->andWhere("q.createdAt LIKE '$now%'")
                    ->setParameter('agence', $agence);
            }
        }

        return $query->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}