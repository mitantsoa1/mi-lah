<?php

namespace App\Repository;

use App\Entity\Fonction;
use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operation>
 *
 * @method Operation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operation[]    findAll()
 * @method Operation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    //    /**
    //     * @return Operation[] Returns an array of Operation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Operation
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getOperationsWithFonction()
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->innerJoin(Fonction::class, 'f', 'o.fonction_id = f.id');
        // ->getQuery()
        // ->getResult();
        // Récupérer et afficher la DQL (Doctrine Query Language)
        $dql = $queryBuilder->getQuery()->getDQL();
        echo "DQL: $dql";

        // Récupérer et afficher la requête SQL
        $sql = $queryBuilder->getQuery()->getSQL();
        echo "SQL: $sql";

        return $queryBuilder->getQuery()->getResult();
    }
}
