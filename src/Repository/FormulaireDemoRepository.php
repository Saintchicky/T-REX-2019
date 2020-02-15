<?php

namespace App\Repository;

use App\Entity\FormulaireDemo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FormulaireDemo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormulaireDemo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormulaireDemo[]    findAll()
 * @method FormulaireDemo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulaireDemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormulaireDemo::class);
    }

    // /**
    //  * @return FormulaireDemo[] Returns an array of FormulaireDemo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormulaireDemo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
