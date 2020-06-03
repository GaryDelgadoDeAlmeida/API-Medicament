<?php

namespace App\Repository;

use App\Entity\AvisASMR;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AvisASMR|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisASMR|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisASMR[]    findAll()
 * @method AvisASMR[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisASMRRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvisASMR::class);
    }

    public function getAvisASMR($offset, $limit)
    {
        return $this->createQueryBuilder('a')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByCodeCIS($offset, $limit, $codeCIS)
    {
        return $this->createQueryBuilder('a')
            ->where('a.codeCIS = :code_cis')
            ->setParameter('code_cis', $codeCIS)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByCodeHAS($offset, $limit, $codeHAS)
    {
        return $this->createQueryBuilder('a')
            ->where('a.codeHAS = :code_has')
            ->setParameter('code_has', $codeHAS)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByEvaluation($offset, $limit, $evalutation)
    {
        return $this->createQueryBuilder('a')
            ->where('a.evaluationMotive = :evaluation')
            ->setParameter('evaluation', $evalutation)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByDate($offset, $limit, $date)
    {
        return $this->createQueryBuilder('a')
            ->where('a.date = :date')
            ->setParameter('date', str_replace('/', '-', $date))
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByValue($offset, $limit, $value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.value = :value')
            ->setParameter('value', $value)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getAvisASMRByCodeCISAndCodeHAS($codeCIS, $codeHAS)
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
    //  * @return AvisASMR[] Returns an array of AvisASMR objects
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
    public function findOneBySomeField($value): ?AvisASMR
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
