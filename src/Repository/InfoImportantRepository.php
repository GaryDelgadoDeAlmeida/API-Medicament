<?php

namespace App\Repository;

use App\Entity\InfoImportant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoImportant|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoImportant|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoImportant[]    findAll()
 * @method InfoImportant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoImportantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoImportant::class);
    }

    public function getInfoImportant($offset, $limit)
    {
        return $this->createQueryBuilder('i')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getInfoByCodeCIS($codeCIS)
    {
        return $this->createQueryBuilder('i')
            ->where('i.codeCIS = :code_cis')
            ->setParameter('code_cis', $codeCIS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getInfoImportantByDateEnd($offset, $limit, $date_end)
    {
        return null;
    }

    public function getInfoImportantByDateStart($offset, $limit, $date_start)
    {
        return null;
    }

    public function getInfoImportantByDateStartAndDateEnd($offset, $limit, $date_start, $date_end)
    {
        return null;
    }

    // /**
    //  * @return InfoImportant[] Returns an array of InfoImportant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoImportant
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
