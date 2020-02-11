<?php

namespace App\Repository;

use App\Entity\DoctrineDemo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DoctrineDemo|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctrineDemo|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctrineDemo[]    findAll()
 * @method DoctrineDemo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineDemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineDemo::class);
    }

    // /**
    //  * @return DoctrineDemo[] Returns an array of DoctrineDemo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctrineDemo
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
