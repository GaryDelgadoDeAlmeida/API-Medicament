<?php

namespace App\Repository;

use App\Entity\AvisSMR;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AvisSMR|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisSMR|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisSMR[]    findAll()
 * @method AvisSMR[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisSMRRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvisSMR::class);
    }

    public function getAvisSMR($offset, $limit)
    {
        return $this->createQueryBuilder('a')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByCodeCIS($offset, $limit, $codeCIS)
    {
        return $this->createQueryBuilder('a')
            ->where('a.codeCIS = :code_cis')
            ->setParameter('code_cis', $codeCIS)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByCodeHAS($offset, $limit, $codeHAS)
    {
        return $this->createQueryBuilder('a')
            ->where('a.codeHAS = :code_has')
            ->setParameter('code_has', $codeHAS)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByEvaluation($offset, $limit, $evalutation)
    {
        return $this->createQueryBuilder('a')
            ->where('a.evaluationMotive = :evaluation')
            ->setParameter('evaluation', $evalutation)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByDate($offset, $limit, $date)
    {
        return $this->createQueryBuilder('a')
            ->where('a.date = :date')
            ->setParameter('date', str_replace('/', '-', $date))
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByValue($offset, $limit, $value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.value = :value')
            ->setParameter('value', $value)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisSMRByCodeCISAndCodeHAS($codeCIS, $codeHAS)
    {
        return $this->createQueryBuilder('a')
            ->where('a.codeCIS = :code_cis')
            ->andWhere('a.codeHAS = :code_has')
            ->setParameter('code_cis', $codeCIS)
            ->setParameter('code_has', $codeHAS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return AvisSMR[] Returns an array of AvisSMR objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AvisSMR
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
