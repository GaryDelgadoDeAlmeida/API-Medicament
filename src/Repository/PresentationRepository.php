<?php

namespace App\Repository;

use App\Entity\Presentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presentation[]    findAll()
 * @method Presentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presentation::class);
    }

    public function getPresentations($offset, $limit)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.codeCIS', 'ASC')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getPresentationByCIS($codeCIS)
    {
        return $this->createQueryBuilder('p')
            ->where('p.codeCIS = :codeCIS')
            ->setParameter('codeCIS', $codeCIS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getPresentationByCIP($codeCIP)
    {
        return $this->createQueryBuilder('p')
            ->where('p.codeCIP = :codeCIP')
            ->setParameter('codeCIP', $codeCIP)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getPresentationByCIP13($codeCIP13)
    {
        return $this->createQueryBuilder('p')
            ->where('p.codeCIP13 = :codeCIP13')
            ->setParameter('codeCIP13', $codeCIP13)
            ->getQuery()
            ->getResult();
    }

    public function getPresentationByName($name)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }

    public function getPresentationByAdministrationStatus($administrationStatus)
    {
        return $this->createQueryBuilder('p')
            ->where('p.administrationStatus = :administrationStatus')
            ->setParameter('administrationStatus', $administrationStatus)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Presentation[] Returns an array of Presentation objects
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
    public function findOneBySomeField($value): ?Presentation
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
