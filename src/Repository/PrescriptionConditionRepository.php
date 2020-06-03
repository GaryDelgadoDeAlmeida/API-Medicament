<?php

namespace App\Repository;

use App\Entity\PrescriptionCondition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrescriptionCondition|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrescriptionCondition|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrescriptionCondition[]    findAll()
 * @method PrescriptionCondition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrescriptionConditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrescriptionCondition::class);
    }

    public function getPrescriptionCondition($offset, $limit)
    {
        return $this->createQueryBuilder('p')
            ->setFirstResult($offset * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getPrescriptionByCodeCIS($codeCIS)
    {
        return $this->createQueryBuilder('p')
            ->where('p.codeCIS = :code_cis')
            ->setParameter('code_cis', $codeCIS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return PrescriptionCondition[] Returns an array of PrescriptionCondition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrescriptionCondition
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
