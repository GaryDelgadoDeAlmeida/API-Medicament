<?php

namespace App\Repository;

use App\Entity\Medicament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medicament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicament[]    findAll()
 * @method Medicament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicament::class);
    }

    /**
     * Return all medicaments of the database
     * 
     * offset => page
     * limit => per page element
     */
    public function getMedicaments($offset, $limit)
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.denomination', 'ASC')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getMedicamentByID($id)
    {
        return $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getMedicamentsByPharmaceuticalForm($offset, $limit, $pharmaceuticalForm)
    {
        return $this->createQueryBuilder('m')
            ->where('m.pharmaceuticalForm = :pharmaceuticalForm')
            ->orderBy('m.denomination', 'ASC')
            ->setParameter('pharmaceuticalForm', $pharmaceuticalForm)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getMedicamentsByAuthorizationStatus($offset, $limit, $authorizationStatus)
    {
        return $this->createQueryBuilder('m')
            ->where('m.authorizationStatus = :authorizationStatus')
            ->orderBy('m.denomination', 'ASC')
            ->setParameter('authorizationStatus', $authorizationStatus)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getMedicamentsByDate($offset, $limit, $date)
    {
        return $this->createQueryBuilder('m')
            ->where('m.date = :date')
            ->orderBy('m.denomination', 'ASC')
            ->setParameter('date', $date)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getMedicamentsByHolder($offset, $limit, $holder)
    {
        return $this->createQueryBuilder('m')
            ->where('m.holder = :holder')
            ->orderBy('m.denomination', 'ASC')
            ->setParameter('holder', $holder)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return Medicament[] Returns an array of Medicament objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicament
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
